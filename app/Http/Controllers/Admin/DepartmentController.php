<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,NULL,id,faculty_id,' . $request->faculty_id,
            'faculty_id' => 'required|exists:faculties,id'
        ]);

        Department::create($validated);
        return redirect()->route('admin.departments.index')->with('success', 'Bölüm başarıyla eklendi.');
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id . ',id,faculty_id,' . $request->faculty_id,
            'faculty_id' => 'required|exists:faculties,id'
        ]);

        $department->update($validated);
        return redirect()->route('admin.departments.index')->with('success', 'Bölüm başarıyla güncellendi.');
    }
} 