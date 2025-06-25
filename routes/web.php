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

use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'search'])->name('searchpage');


Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/item/{id}', [App\Http\Controllers\HomeController::class, 'showProduct'])->name('item.show');

Route::get('/userpage', function () {
    return view('userpage'); // corresponds to resources/views/userpage.blade.php
})->name('userpage');

Route::get('/itempage', function () {
    return view('itempage'); // corresponds to resources/views/itempage.blade.php
})->name('itempage');


Route::put('/user/profile', [UserController::class, 'update'])->name('user.profile.update')->middleware('auth');