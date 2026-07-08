<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;


Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/teacher/login', [TeacherLoginController::class, 'showLoginForm'])->name('teacher.login');
Route::post('/teacher/login', [TeacherLoginController::class, 'login'])->name('teacher.login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/schedule', [AdminController::class, 'schedule'])->name('admin.schedule');
    Route::get('/admin/change-password/{id}', [AdminController::class, 'showChangePassword'])->name('admin.change-password');
    Route::post('/admin/update-password/{id}', [AdminController::class, 'updatePassword'])->name('admin.update-password');
    Route::get('/admin/generate-schedule', [AdminController::class, 'generateSchedule'])->name('admin.generate-schedule');
    Route::get('/admin/replacement/{id}', [AdminController::class, 'showReplacement'])->name('admin.replacement');
    Route::post('/admin/assign-replacement/{id}', [AdminController::class, 'assignReplacement'])->name('admin.assign-replacement');
    Route::get('/admin/schedule/clear', [AdminController::class, 'clearSchedules'])->name('admin.schedule.clear');
    Route::get('/admin/schedule/generate/{grade}', [AdminController::class, 'generateGradeSchedule'])->name('admin.schedule.generate-grade');
});

Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherLoginController::class, 'dashboard'])->name('teacher.dashboard');
    Route::post('/teacher/logout', [TeacherLoginController::class, 'logout'])->name('teacher.logout');
    Route::post('/teacher/mark-unavailable', [TeacherLoginController::class, 'markUnavailable'])->name('teacher.mark-unavailable');
    Route::post('/teacher/mark-available', [TeacherLoginController::class, 'markAvailable'])->name('teacher.mark-available');
});


Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');


Route::get('/test', function() {
    return 'Hello World!';
});
Route::get('/', function () {
    return view('landing');
});
Route::get('/login', function () {
    return redirect('/');
})->name('login');