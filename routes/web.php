<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/petpage', function () {
    return view('petpage'); // corresponds to resources/views/petpage.blade.php
});

Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/item/{id}', [App\Http\Controllers\HomeController::class, 'showProduct'])->name('item.show');

Route::get('/userpage', function () {
    return view('userpage'); // corresponds to resources/views/petpage.blade.php
});

Route::put('/user/profile', [UserController::class, 'update'])->name('user.profile.update')->middleware('auth');