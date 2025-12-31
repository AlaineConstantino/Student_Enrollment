<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('my-students', [StudentController::class, 'index'])->name('my-students');
    Route::get('enroll-child', [EnrollmentController::class, 'createForParent'])->name('enroll-child');
    Route::post('/enroll', [EnrollmentController::class, 'store']);
    Route::get('students/{student}/edit-parent', [StudentController::class, 'editParent'])->name('students.edit-parent');
    Route::put('students/{student}/update-parent', [StudentController::class, 'updateParent'])->name('students.update-parent');
    Route::delete('students/{student}/destroy-parent', [StudentController::class, 'destroyParent'])->name('students.destroy-parent');
    Route::post('students/{id}/restore-parent', [StudentController::class, 'restoreParent'])->name('students.restore-parent');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('students', StudentController::class)->middleware('role:admin');
    Route::get('students', [StudentController::class, 'index'])->name('students.index')->withoutMiddleware('role:admin');
    Route::resource('enrollments', EnrollmentController::class)->except(['show']);
    Route::patch('enrollments/{id}/status', [EnrollmentController::class, 'updateStatus']);
    Route::resource('classes', ClassController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::post('users/{id}/restore', [\App\Http\Controllers\UserController::class, 'restore'])->name('users.restore');
    Route::post('students/{student}/restore', [StudentController::class, 'restore'])->name('students.restore');
    Route::post('teachers/{id}/restore', [TeacherController::class, 'restore'])->name('teachers.restore');
    Route::post('classes/{id}/restore', [ClassController::class, 'restore'])->name('classes.restore');
    Route::post('enrollments/{id}/restore', [EnrollmentController::class, 'restore'])->name('enrollments.restore');
    Route::get('/admin/enrollments', [EnrollmentController::class, 'index']);
});

require __DIR__.'/auth.php';
