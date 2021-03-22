<?php

use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Artisan;
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



// RUTAS PARA EL MANTENIMIENTO DE LA APLICACIÓN EN PRODUCCIÓN
// Ruta para ejecutar en producción: $ php artisan key:generate
Route::get('key-generate', function(){
    Artisan::call('key:generate');
});

// Ruta para ejecutar en producción: $ php artisan storage:link
Route::get('storage-link', function(){
    Artisan::call('storage:link');
});

// Ruta para ejecutar en producción: $ php artisan config:cache
Route::get('config-cache', function(){
    Artisan::call('config:cache');
});

// Ruta para ejecutar en producción: $ php artisan cache:clear
Route::get('cache-clear', function(){
    Artisan::call('cache:clear');
});

// Ruta para ejecutar en producción: $ php artisan route:clear
Route::get('route-clear', function(){
    Artisan::call('route:clear');
});

// Ruta para ejecutar en producción: $ php artisan config:clear
Route::get('config-clear', function(){
    Artisan::call('config:clear');
});

// Ruta para ejecutar en producción: $ php artisan view:clear
Route::get('view-clear', function(){
    Artisan::call('view:clear');
});


