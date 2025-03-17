<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseStudentController;
use App\Livewire\Courses\CreateCourses;

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth')->name('dashboard');




// Route::middleware('auth')->group(function () {
//     Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
//     Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
//     Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
//     Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
//     Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
//     Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
// });


Route::middleware('auth')->group(function () {
    Route::get('/courses/create', CreateCourses::class)->name('courses.create');

});

Route::middleware('auth')->group(function () {
    Route::get('course_students', [CourseStudentController::class, 'index'])->name('course_students.index');
    Route::get('course_students/create', [CourseStudentController::class, 'create'])->name('course_students.create');
    Route::post('course_students', [CourseStudentController::class, 'store'])->name('course_students.store');
    Route::get('course_students/{courseStudent}/edit', [CourseStudentController::class, 'edit'])->name('course_students.edit');
    Route::put('course_students/{courseStudent}', [CourseStudentController::class, 'update'])->name('course_students.update');
    Route::delete('course_students/{courseStudent}', [CourseStudentController::class, 'destroy'])->name('course_students.destroy');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
