<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('teacher.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('teacher')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->route('teacher.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function dashboard()
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.dashboard', compact('teacher'));
    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect('/teacher/login');
    }

    public function markUnavailable(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();
        $teacher->is_available = false;
        $teacher->unavailable_date = now()->toDateString();
        $teacher->unavailable_reason = $request->reason ?? 'Not specified';
        $teacher->save();

        return back()->with('success', 'You have been marked as unavailable.');
    }

    public function markAvailable()
    {
        $teacher = Auth::guard('teacher')->user();
        $teacher->is_available = true;
        $teacher->unavailable_date = null;
        $teacher->unavailable_reason = null;
        $teacher->save();

        return back()->with('success', 'You are now marked as available.');
    }
    protected function redirectTo()
{
    if (Auth::guard('teacher')->check()) {
        return route('teacher.dashboard');
    }
    return route('teacher.login');
}
}