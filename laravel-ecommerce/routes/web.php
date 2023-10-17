<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ExampleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', [ProductController::class, 'list']);

Route::get('/product/list/{category}', [ProductController::class, 'list'])->name('product.list');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/wishlist' , [CartController::class, 'index'])->name('wishlist');

Route::get('/checkout', function ()  {
    return 'wishlist';
})->name('checkout');
Route::get('/wishlist', function ()  {
    return 'wishlist';
})->name('wishlist');
Route::get('/contact', function ()  {
    return 'contact';
})->name('contact');

Route::get('/example' , [ExampleController::class, 'index'])->name('example');