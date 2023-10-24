<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/form-validate', [HomeController::class, 'formValidate'])->name('form-validate');

Route::prefix('file')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('file.index');
    Route::post('/store', [FileController::class, 'store'])->name('file.store');
});
