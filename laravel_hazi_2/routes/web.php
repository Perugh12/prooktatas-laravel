<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

# 1
Route::get('/welcome', function () {
    return 'Hello, World!';
});

# 2
Route::get('/user/{username}', [UserController::class, 'index']);

# 3, 4, 5
Route::prefix('admin')->group(function () {
    # Select all users
    Route::get('/list', [UserController::class, 'list'])->name('user.list');

    # Select a user by ID
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

    # Create a new user
    Route::post('/user/add', [UserController::class, 'store'])->name('user.store');

    # Update a user
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

    # Delete a user
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');


    # 6
    Route::get('params/{limit?}', [UserController::class, 'datatable'])->name('user.datatable');
});

# 7
Route::get('/user/profile/{username}', function ($username) {
    // testUser()
    return "Profile of $username";
});

# 8
Route::get('/redirect', function () {
    return redirect()->route('user.list');
});
