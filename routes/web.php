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
Route::get('delete-student/{id}',[StudentController::class,'deleteStudent'])->name('deleteStudent');  // Added the Student 

Route::get('search',[StudentController::class,'searchStudent'])->name('search');  // search a student to get

Route::get('users-search',[StudentController::class,'userSearch'])->name('userSearch');  // search multiple stuent to get


Route::get('filter',[StudentController::class,'filterProduct'])->name('filter');  // search multiple stuent to get


Route::controller(StudentController::class)->group(function(){
Route::get('file-upload','index');
Route::post('file-upload','store')->name('file.store');

});
