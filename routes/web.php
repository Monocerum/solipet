<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});

// Legal pages
Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');

// Custom authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

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

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/promotions', [AdminController::class, 'promotions'])->name('promotions');
});

// For CRUD functions.
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create'); // Same na nare-read si Inventory and automatically nags-separate.
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    Route::delete('/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('admin.customers.delete');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
Route::get('/customers', [App\Http\Controllers\AdminController::class, 'customers'])->name('customers');
    Route::get('/customers/{id}', [App\Http\Controllers\AdminController::class, 'showCustomer'])->name('customers.show');
    Route::get('/customers/{id}/edit', [App\Http\Controllers\AdminController::class, 'editCustomer'])->name('customers.edit');
    Route::put('/customers/{id}', [App\Http\Controllers\AdminController::class, 'updateCustomer'])->name('customers.update');
    Route::delete('/customers/{id}', [App\Http\Controllers\AdminController::class, 'deleteCustomer'])->name('customers.delete');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Payment Management Routes
    Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments');
    Route::get('/payments/{payment}', [App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('payments.show');
    Route::patch('/payments/{payment}/status', [App\Http\Controllers\Admin\PaymentController::class, 'updateStatus'])->name('payments.update-status');
    
    // Promotion Management Routes
    Route::get('/payments/promotions/manage', [App\Http\Controllers\Admin\PaymentController::class, 'promotions'])->name('payments.promotions');
    Route::get('/payments/promotions/create', [App\Http\Controllers\Admin\PaymentController::class, 'createPromotion'])->name('payments.promotions.create');
    Route::post('/payments/promotions', [App\Http\Controllers\Admin\PaymentController::class, 'storePromotion'])->name('payments.promotions.store');
    Route::patch('/promotions/{promotion}/toggle', [App\Http\Controllers\Admin\PaymentController::class, 'togglePromotionStatus'])->name('promotions.toggle');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
});


Route::put('/user/profile', [UserController::class, 'update'])->name('user.profile.update')->middleware('auth');
Route::put('/user/password', [UserController::class, 'updatePassword'])->name('user.password.update')->middleware('auth');

Route::get('/pet/{pet_type}', [PetController::class, 'showByType'])->name('petpage');

Route::get('/viewCart', [CartController::class, 'viewCart'])->name('viewCart');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart')->middleware('auth');
Route::post('/buy-now', [CartController::class, 'buyNow'])->name('buy.now')->middleware('auth');

Route::post('/submit-review', [App\Http\Controllers\HomeController::class, 'submitReview'])->name('submit.review')->middleware('auth');

Route::post('/cart/item/{itemId}/quantity', [CartController::class, 'updateQuantity'])->name('cart.item.updateQuantity')->middleware('auth');

Route::post('/cart/item/{itemId}/remove', [CartController::class, 'removeItem'])->name('cart.item.remove')->middleware('auth');

Route::post('/cart/address', [CartController::class, 'updateAddress'])->name('cart.address.update')->middleware('auth');

Route::post('/pay', [UserController::class, 'pay'])->name('pay')->middleware('auth');

Route::post('/checkout', [UserController::class, 'checkout'])->name('checkout')->middleware('auth');

Route::post('/order/{order}/pay', [UserController::class, 'payOrder'])->name('order.pay')->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
});

Route::patch('/admin/payments/{payment}/update-status', [PaymentController::class, 'updateStatus'])
    ->name('admin.payments.update-status');

Route::get('/admin/products/{id}', [AdminProductController::class, 'show'])->name('admin.products.show');
