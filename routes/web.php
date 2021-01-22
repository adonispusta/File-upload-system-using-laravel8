<?php

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('file/create' , [\App\Http\Controllers\FileController::class , 'create' ])->name('file.create');
Route::post('file/create' , [\App\Http\Controllers\FileController::class , 'store' ])->name('file.store');
Route::get('file' , [\App\Http\Controllers\FileController::class , 'index' ])->name('file.index');
Route::get('file/{file}' , [\App\Http\Controllers\FileController::class , 'show' ])->name('file.show');
Route::get('file/delete/{file}' , [\App\Http\Controllers\FileController::class , 'delete' ])->name('file.delete');