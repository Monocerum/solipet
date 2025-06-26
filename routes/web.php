<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/petpage', function () {
    return view('petpage'); // corresponds to resources/views/petpage.blade.php
});


Route::get('/search', [SearchController::class, 'search'])->name('searchpage');


Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/item/{id}', [App\Http\Controllers\HomeController::class, 'showProduct'])->name('item.show');

Route::get('/userpage', [UserController::class, 'showUserPage'])->name('userpage')->middleware('auth');

Route::get('/itempage', function () {
    return view('itempage'); // corresponds to resources/views/itempage.blade.php
})->name('itempage');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/promotions', [AdminController::class, 'promotions'])->name('promotions');
});


Route::put('/user/profile', [UserController::class, 'update'])->name('user.profile.update')->middleware('auth');
Route::put('/user/password', [UserController::class, 'updatePassword'])->name('user.password.update')->middleware('auth');

Route::get('/pet/{pet_type}', [PetController::class, 'showByType'])->name('petpage');

Route::get('/viewCart', [CartController::class, 'viewCart'])->name('viewCart');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart')->middleware('auth');

Route::post('/cart/item/{itemId}/quantity', [CartController::class, 'updateQuantity'])->name('cart.item.updateQuantity')->middleware('auth');

Route::post('/cart/item/{itemId}/remove', [CartController::class, 'removeItem'])->name('cart.item.remove')->middleware('auth');

Route::post('/cart/address', [CartController::class, 'updateAddress'])->name('cart.address.update')->middleware('auth');

Route::post('/pay', [UserController::class, 'pay'])->name('pay')->middleware('auth');

Route::post('/checkout', [UserController::class, 'checkout'])->name('checkout')->middleware('auth');
