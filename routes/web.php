<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/fetch', [ProductController::class, 'fetchAndStore'])->name('products.fetch');


