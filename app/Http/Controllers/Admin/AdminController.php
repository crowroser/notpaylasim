<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                return redirect('/')->with('error', 'Bu sayfaya erişim yetkiniz yok.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $pendingNotes = Note::where('is_approved', false)->with(['user', 'faculty', 'department'])->get();
        $approvedNotes = Note::where('is_approved', true)->with(['user', 'faculty', 'department'])->get();
        $facultyCount = Faculty::count();
        $departmentCount = Department::count();

        return view('admin.dashboard', compact('pendingNotes', 'approvedNotes', 'facultyCount', 'departmentCount'));
    }

    public function approveNote(Note $note)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back()->with('error', 'Bu işlem için yetkiniz yok.');
        }

        $note->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'Not başarıyla onaylandı.');
    }

    public function rejectNote(Note $note)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back()->with('error', 'Bu işlem için yetkiniz yok.');
        }

        $note->delete();
        return redirect()->back()->with('success', 'Not başarıyla reddedildi.');
    }

    public function deleteNote(Note $note)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back()->with('error', 'Bu işlem için yetkiniz yok.');
        }

        $note->delete();
        return redirect()->back()->with('success', 'Not başarıyla silindi.');
    }
}