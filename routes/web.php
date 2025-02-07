<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

// Ana sayfa ve kimlik doğrulama route'ları
Route::get('/', [NoteController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Şifre sıfırlama rotaları
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Kimlik doğrulaması gerektiren route'lar
Route::middleware(['auth'])->group(function () {
    // Not görüntüleme için özel rota
    Route::get('/notes/{note}/view', [NoteController::class, 'view'])->name('notes.view');
    Route::resource('notes', NoteController::class);
    Route::get('/search', [NoteController::class, 'search'])->name('notes.search');
    Route::get('/api/departments/{faculty}', function($faculty) {
        return App\Models\Department::where('faculty_id', $faculty)->get();
    })->name('api.departments');
    Route::get('/api/classes/{department}', [ApiController::class, 'classes'])->name('api.classes');
    Route::get('/api/courses/{class}', [ApiController::class, 'courses'])->name('api.courses');
});

// Admin paneli route'ları (tek bir grup altında toplandı)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Not onaylama/reddetme işlemleri
    Route::post('/notes/{note}/approve', [AdminController::class, 'approveNote'])->name('notes.approve');
    Route::post('/notes/{note}/reject', [AdminController::class, 'rejectNote'])->name('notes.reject');
    
    // Kaynak yönetimi route'ları
    Route::resource('faculties', FacultyController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('courses', CourseController::class);
});

Auth::routes();

Route::redirect('/home', '/');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/notes/{note}/approve', [AdminController::class, 'approveNote'])->name('notes.approve');
    Route::post('/notes/{note}/reject', [AdminController::class, 'rejectNote'])->name('notes.reject');
    Route::delete('/notes/{note}', [AdminController::class, 'deleteNote'])->name('notes.delete');
    // ...diğer admin route'ları...
});
