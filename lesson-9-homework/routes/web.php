<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\ExampleSessionController;
use Symfony\Component\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

#1
Route::get('/method/{name}', [MethodController::class, 'index'])->name('method.index');

#2
Route::get('/validation', [ValidationController::class, 'index'])->name('validation.index');
Route::post('/validation', [ValidationController::class, 'form'])->name('validation.form');

#3
Route::prefix('file')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('file.index');
    Route::post('/store', [FileController::class, 'store'])->name('file.store');
});

#4
Route::prefix('session')->group(function () {
    #6
    Route::get('/', [ExampleSessionController::class, 'index'])->name('session.index');
    Route::get('/add/{id}', [ExampleSessionController::class, 'set'])->name('session.set');
    #8
    Route::get('/destroy', [ExampleSessionController::class, 'destroy'])->name('session.destroy');
    #9
    Route::get('/get/{id}', [ExampleSessionController::class, 'get'])->name('session.get');    
    #10
    Route::get('/update/{id}', [ExampleSessionController::class, 'update'])->name('session.update');
});
