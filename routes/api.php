<?php

use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(ProductsController::class)->group(function () {
    Route::get('products', 'index');
    Route::post('addProduct', 'createProduct');
    Route::post('deleteProduct', 'deleteProduct');
    Route::post('updateProduct', 'updateProduct');
});

Route::controller(CartsController::class)->group(function () {
    Route::post('newCart', 'createCart');
    Route::post('deleteCart', 'deleteCart'  );
});

Route::controller(CartItemsController::class)->group(function () {
    Route::get('cart', 'index');
    Route::post('addItem', 'store');
});
