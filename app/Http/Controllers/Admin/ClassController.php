<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classes,name,NULL,id,department_id,' . $request->department_id,
            'department_id' => 'required|exists:departments,id'
        ]);

        ClassRoom::create($validated);
        return redirect()->route('admin.classes.index')->with('success', 'Sınıf başarıyla eklendi.');
    }

    public function update(Request $request, ClassRoom $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classes,name,' . $class->id . ',id,department_id,' . $request->department_id,
            'department_id' => 'required|exists:departments,id'
        ]);

        $class->update($validated);
        return redirect()->route('admin.classes.index')->with('success', 'Sınıf başarıyla güncellendi.');
    }

    public function destroy(ClassRoom $class)
    {
        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Sınıf başarıyla silindi.');
    }
} 