<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;



// Route::get('/', [ClassController::class, 'index']);

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/teachers-create', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/{id}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::get('/teacher/delete/{id}', [TeacherController::class, 'destroy'])->name('teacher.delete');



    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students-create', [StudentController::class, 'store'])->name('student.store');
    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::get('/student/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');


    Route::get('/class', [ClassController::class, 'index'])->name('class.index');
    Route::post('/class-create', [ClassController::class, 'store'])->name('class.store');
    Route::get('/class/{id}/edit', [ClassController::class, 'edit'])->name('class.edit');
    Route::put('/class/{id}', [ClassController::class, 'update'])->name('class.update');
    Route::get('/class/delete/{id}', [ClassController::class, 'destroy'])->name('class.delete');
});
