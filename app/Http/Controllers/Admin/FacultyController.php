<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::all();
        return view('admin.faculty.index', compact('faculties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faculties'
        ]);

        Faculty::create($validated);
        return redirect()->route('admin.faculties.index')->with('success', 'Fakülte başarıyla eklendi.');
    }

    public function update(Request $request, Faculty $faculty)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faculties,name,' . $faculty->id
        ]);

        $faculty->update($validated);
        return redirect()->route('admin.faculties.index')->with('success', 'Fakülte başarıyla güncellendi.');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('admin.faculties.index')->with('success', 'Fakülte başarıyla silindi.');
    }
} 