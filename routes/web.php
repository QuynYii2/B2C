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

Route::get('lang/{lang}','LangController@lang')->name('lang');

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'saveLogin'])->name('login.save');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'saveRegister'])->name('register.save');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');
    Route::get('/search-product', [App\Http\Controllers\DashboardController::class, 'search_product']);
    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'searchProduct'])->name('search');
    Route::get('/detail-product/{service}/{id}', [\App\Http\Controllers\SearchController::class, 'getDetailProduct'])->name('product.detail');
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'showCart'])->name('cart.index');
    Route::post('/cart/add', [\App\Http\Controllers\CartController::class,'addToCart'])->name('cart.add');
    Route::post('/update-cart-quantity', [\App\Http\Controllers\CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/update-cart-quantity', [\App\Http\Controllers\CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/delete-cart-item/{itemId}', [\App\Http\Controllers\CartController::class, 'deleteCartItem'])->name('cart.delete');
    Route::delete('/delete-all-cart-items', [\App\Http\Controllers\CartController::class, 'deleteAllCartItems'])->name('cart/delete-all');
    // Checkout
    Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'processPayment'])->name('checkout.process');
    // Paypal
    Route::get('/checkout-success/{name}/{email}/{phone}/{address}/{ware_house}', [\App\Http\Controllers\CheckoutController::class, 'successPayment'])->name('checkout.success');
    Route::post('/checkout-paypal', [\App\Http\Controllers\CheckoutController::class, 'createPayment'])->name('checkout.create');
    Route::get('/cancel-checkout', [\App\Http\Controllers\CheckoutController::class, 'cancelPayment'])->name('checkout.cancel');
    //
    Route::get('/warehouse', [\App\Http\Controllers\WarehouseController::class, 'index'])->name('warehouse.index');
    Route::get('/create-warehouse', [\App\Http\Controllers\WarehouseController::class, 'processCreate'])->name('warehouse.processCreate');
    Route::post('/warehouse', [\App\Http\Controllers\WarehouseController::class, 'create'])->name('warehouse.create');
    Route::get('/warehouse/{id}', [\App\Http\Controllers\WarehouseController::class, 'detail'])->name('warehouse.detail');
    Route::post('/warehouse/{id}', [\App\Http\Controllers\WarehouseController::class, 'update'])->name('warehouse.update');
});


