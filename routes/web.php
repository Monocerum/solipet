<?php

use Illuminate\Support\Facades\Route;

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