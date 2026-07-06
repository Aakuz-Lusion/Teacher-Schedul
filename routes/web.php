<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherLoginController;
use App\Http\Controllers\AdminController;

// ============================================
// WELCOME PAGE
// ============================================
Route::get('/', function () {
    return view('welcome');
});

// ============================================
// TEACHER MANAGEMENT ROUTES
// ============================================
Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');

// ============================================
// TEACHER LOGIN ROUTES
// ============================================
Route::get('/teacher/login', [TeacherLoginController::class, 'showLoginForm'])->name('teacher.login');
Route::post('/teacher/login', [TeacherLoginController::class, 'login'])->name('teacher.login.post');
Route::get('/teacher/dashboard', [TeacherLoginController::class, 'dashboard'])->name('teacher.dashboard')->middleware('auth:teacher');
Route::post('/teacher/logout', [TeacherLoginController::class, 'logout'])->name('teacher.logout');

// ============================================
// TEACHER AVAILABILITY ROUTES
// ============================================
Route::post('/teacher/mark-unavailable', [TeacherLoginController::class, 'markUnavailable'])->name('teacher.mark-unavailable')->middleware('auth:teacher');
Route::post('/teacher/mark-available', [TeacherLoginController::class, 'markAvailable'])->name('teacher.mark-available')->middleware('auth:teacher');

// ============================================
// ADMIN ROUTES
// ============================================
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/change-password/{id}', [AdminController::class, 'showChangePassword'])->name('admin.change-password');
Route::post('/admin/update-password/{id}', [AdminController::class, 'updatePassword'])->name('admin.update-password');
Route::get('/admin/generate-schedule', [AdminController::class, 'generateSchedule'])->name('admin.generate-schedule');
Route::get('/admin/replacement/{id}', [AdminController::class, 'showReplacement'])->name('admin.replacement');
Route::post('/admin/assign-replacement/{id}', [AdminController::class, 'assignReplacement'])->name('admin.assign-replacement');

// ============================================
// TEST ROUTE (Remove in production)
// ============================================
Route::get('/test', function() {
    return 'Hello World!';
});
Route::get('/admin/schedule', [AdminController::class, 'schedule'])->name('admin.schedule');