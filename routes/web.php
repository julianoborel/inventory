<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UserController');
Route::resource('products', 'ProductController');
Route::resource('stocks', 'StockController');
Route::resource('requests', 'RequestController');
