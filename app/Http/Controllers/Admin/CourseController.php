<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['classRoom.department.faculty'])->get();
        $classes = ClassRoom::with(['department.faculty'])->get();
        return view('admin.course.index', compact('courses', 'classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'code' => 'required|string|max:20|unique:courses',
            'description' => 'nullable|string|max:1000'
        ]);

        Course::create($validated);
        return redirect()->route('admin.courses.index')->with('success', 'Ders başarıyla eklendi.');
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'code' => 'required|string|max:20|unique:courses,code,' . $course->id,
            'description' => 'nullable|string|max:1000'
        ]);

        $course->update($validated);
        return redirect()->route('admin.courses.index')->with('success', 'Ders başarıyla güncellendi.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Ders başarıyla silindi.');
    }
} 