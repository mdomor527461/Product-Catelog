<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
Route::get('/', function () {
    return view('task.task');
});

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/get', [CartController::class, 'getCart'])->name('cart.get');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
