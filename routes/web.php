<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\WarehouseController;
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

//Route::get('lang/{lang}', 'LangController@lang')->name('lang');
Route::get('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'saveLogin'])->name('login.save');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'saveRegister'])->name('register.save');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/search-product', [App\Http\Controllers\DashboardController::class, 'search_product']);
    Route::get('/search', [SearchController::class, 'searchProduct'])->name('search');
    Route::get('/detail-product/{service}/{id}', [SearchController::class, 'getDetailProduct'])->name('product.detail');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/update-cart-quantity', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/delete-cart-item/{itemId}', [CartController::class, 'deleteCartItem'])->name('cart.delete');
    Route::delete('/delete-all-cart-items', [CartController::class, 'deleteAllCartItems'])->name('cart/delete-all');
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'processPayment'])->name('checkout.process');
    // Paypal
    Route::get('/checkout-success/{name}/{email}/{phone}/{address}/{ware_house}/{total_income}', [CheckoutController::class, 'successPayment'])->name('checkout.success');
    Route::post('/checkout-paypal', [CheckoutController::class, 'createPayment'])->name('checkout.create');
    Route::get('/cancel-checkout', [CheckoutController::class, 'cancelPayment'])->name('checkout.cancel');
    // warehouse
    Route::get('/warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
    Route::get('/create-warehouse', [WarehouseController::class, 'processCreate'])->name('warehouse.processCreate');
    Route::post('/warehouse', [WarehouseController::class, 'create'])->name('warehouse.create');
    Route::get('/warehouse/{id}', [WarehouseController::class, 'detail'])->name('warehouse.detail');
    Route::post('/warehouse/{id}', [WarehouseController::class, 'update'])->name('warehouse.update');
    // order
    Route::get('/order-list', [OrderController::class, 'list'])->name('order.list');
    Route::post('/order-list', [OrderController::class, 'list'])->name('order.list.search');
    Route::get('/order-detail/{id}', [OrderController::class, 'detail'])->name('order.detail');
    Route::post('/order-manager', [OrderController::class, 'index'])->name('order.manager.search');
    Route::get('/api/deposit/list', [DepositController::class, 'indexApi']);
    // charts
    Route::get('/statistic-order-search', [StatisticController::class, 'indexSearch'])->name('statistic.index.order.search');
    Route::get('/statistic-access', [StatisticController::class, 'indexAccess'])->name('statistic.index.access');
    Route::post('/order-cancel/{id}', [OrderController::class, 'cancelOrder'])->name('order.cancel');
});

Route::group(['middleware' => 'role.admin'], function () {
    Route::get('/deposit/list', [DepositController::class, 'index'])->name('deposit.index');
    Route::get('/deposit/detail/{id}', [DepositController::class, 'detail'])->name('deposit.detail');
    Route::post('/deposit/{id}', [DepositController::class, 'update'])->name('deposit.update');
    Route::get('/create-deposit', [DepositController::class, 'create'])->name('deposit.processCreate');
    Route::post('/deposit', [DepositController::class, 'store'])->name('deposit.create');
    Route::post('/deposit/delete/{id}', [DepositController::class, 'destroy'])->name('deposit.delete');
    // order
    Route::get('/order-manager', [OrderController::class, 'index'])->name('order.manager.index');
    Route::post('/order-manager', [OrderController::class, 'index'])->name('order.manager.search');
    Route::get('/order-review/{id}', [OrderController::class, 'review'])->name('order.manager.review');
    Route::post('/order/{id}', [OrderController::class, 'updateOrder'])->name('order.update');
    Route::post('/order-item/{id}', [OrderController::class, 'updateOrderItems'])->name('order.item.update');
    // charts
    Route::get('/statistic-search', [StatisticController::class, 'statisticSearch'])->name('statistic.list.search');
    Route::post('/statistic-search', [StatisticController::class, 'statisticSearch'])->name('statistic.search');
    Route::get('/statistic-order', [StatisticController::class, 'statisticOrder'])->name('statistic.list.order');
    Route::post('/statistic-order', [StatisticController::class, 'statisticOrder'])->name('statistic.order');
    Route::get('/statistic-revenue', [StatisticController::class, 'statisticRevenue'])->name('statistic.list.revenue');
    Route::post('/statistic-revenue', [StatisticController::class, 'statisticRevenue'])->name('statistic.revenue');
    Route::get('/statistic-cancel', [StatisticController::class, 'statisticCancel'])->name('statistic.list.cancel');
    Route::post('/statistic-cancel', [StatisticController::class, 'statisticCancel'])->name('statistic.cancel');
});
