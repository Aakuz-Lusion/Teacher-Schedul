<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'password' => 'required|min:6',
            'subject' => 'required|string',
            'grade' => 'required|string',
            'priority' => 'required|in:high,medium,low',
            'days' => 'required|array|min:3|max:6',
            'periods' => 'required|array|min:3|max:5',
        ]);

        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'subject' => $request->subject,
            'grade' => $request->grade,
            'priority' => $request->priority,
            'days' => $request->days,
            'periods' => $request->periods,
        ]);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher added successfully!');
    }
}