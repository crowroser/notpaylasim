<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Department;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function departments(Faculty $faculty)
    {
        return response()->json($faculty->departments);
    }

    public function classes($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        return response()->json(['class_count' => $department->class_count], 200);
    }

    public function courses(ClassRoom $class)
    {
        return response()->json($class->courses);
    }
}