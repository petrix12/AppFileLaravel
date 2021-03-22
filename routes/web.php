<?php

use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::post('/upload', [FilesController::class, 'store'])->name('user.files.store');

Route::get('/files', [FilesController::class, 'index'])->name('user.files.index');

Route::get('/ver/{file}', [FilesController::class, 'ver'])->name('user.files.ver');

Route::get('/files/{file}', [FilesController::class, 'show'])->name('user.files.show');

Route::delete('/delet-file/{file}', [FilesController::class, 'destroy'])->name('user.files.destroy');

