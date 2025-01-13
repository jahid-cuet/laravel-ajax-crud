<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/add-user', function () {
    return view('form');                // This is for showing the form 
});

Route::get('/get-student', function () {
    return view('getStudent');                // This is for showing the table of all student page 
});

Route::post('add-student',[StudentController::class,'addStudent'])->name('addStudent');  // Added the Student 
Route::get('get-all-student',[StudentController::class,'getStudent'])->name('getStudent');  // Added the Student 
Route::get('edit-student/{id}',[StudentController::class,'editStudent'])->name('editStudent');  // Added the Student 
Route::post('update-student',[StudentController::class,'updateStudent'])->name('updateStudent');  // Added the Student 
require __DIR__.'/auth.php';
