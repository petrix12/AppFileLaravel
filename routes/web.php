<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    // return view('welcome');
    return view('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/upload', [FilesController::class, 'store'])->name('user.files.store');

Route::get('/files', [FilesController::class, 'index'])->name('user.files.index');

Route::get('/ver/{file}', [FilesController::class, 'ver'])->name('user.files.ver');

Route::get('/files/{file}', [FilesController::class, 'show'])->name('user.files.show');

Route::delete('/delet-file/{file}', [FilesController::class, 'destroy'])->name('user.files.destroy');
