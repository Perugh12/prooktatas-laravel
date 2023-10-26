<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/install', [InstallController::class, 'index']);

// Chart api calls /api/cart/count, /api/cart/add, /api/cart/update, /api/cart/remove/1/1
Route::controller(CartController::class)->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/count', 'count')->name('cart.count');
        Route::post('/add', 'add')->name('cart.add');
        Route::patch('/change-quantity', 'changeQuantity')->name('cart.change-quantity');
        Route::delete('/remove/{id}', 'remove')->name('cart.remove');
    });
});

Route::controller(WishlistController::class)->group(function () {
    Route::prefix('wishlist')->group(function () {
        Route::get('/count', 'count')->name('wishlist.count');
        Route::post('/add', 'add')->name('wishlist.add');
        Route::put('/update', 'update')->name('wishlist.update');
        Route::delete('/remove/{id}', 'remove')->name('wishlist.remove');
    });
});

Route::controller(ExampleController::class)->group(function () {
    Route::prefix('example')->group(function () {
        Route::get('/list', 'list')->name('example.list');       
        Route::put('/add', 'add')->name('example.add');
        Route::patch('/update', 'update')->name('example.update');
        Route::delete('/remove', 'remove')->name('example.remove');        
    });
});
