<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// Route to display the list of students
Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');

// Route to store a new student
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');

// Route to update a student
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');

// Route to delete a student
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
