<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

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

Route::controller(OrderController::class)->group(function () {
    Route::prefix('order')->group(function () {
        Route::post('/billing-address', 'billingAddressStore')->name('order.billing.address.store');
        Route::post('/shipping-address', 'shippingAddressStore')->name('order.shipping.address.store');
        Route::post('/payment-method', 'paymentMethodStore')->name('order.payment.method.store');
        Route::post('/shipping-method', 'shipmentMethodStore')->name('order.shipment.method.store');
        Route::get('/summary', 'summary')->name('order.summary');
        Route::get('/products', 'products')->name('order.products');
        Route::post('/store', 'store')->name('order.store');
        // Route::delete('/product-remove/{id}', 'remove')->name('order.remove');
        Route::delete('/remove/{id}', 'remove')->name('order.remove');
    });
});

Route::prefix('admin')->group(function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/login', 'login')->name('admin.login');
        Route::get('/logout', 'logout')->name('admin.logout');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(AdminOrderController::class)->group(function () {
            Route::get('/orders', 'index')->name('admin.orders');
        });

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('/profile', 'show')->name('admin.profile.show');
            Route::patch('/profile', 'update')->name('admin.profile.update');
            Route::delete('/profile', 'delete')->name('admin.profile.delete');
        });
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



/*Route::controller(ExampleController::class)->group(function () {
    Route::prefix('example')->group(function () {
        Route::get('/list', 'list')->name('example.list');
        Route::put('/add', 'add')->name('example.add');
        Route::patch('/update', 'update')->name('example.update');
        Route::delete('/remove', 'remove')->name('example.remove');
    });
});*/
