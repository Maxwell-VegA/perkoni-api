<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImgController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;

Route::middleware('auth:user')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Authentication'], function() {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    Route::post('register', 'RegisterController');

    Route::get('user', 'UserController');
});


// Route::get('/products', [ProductController::class, 'index'])->middleware('vendor');
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/related', [ProductController::class, 'related']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart', [CartController::class, 'store']);
Route::patch('/cart/{id}', [CartController::class, 'update']);
Route::delete('/cart/{id}', [CartController::class, 'delete']);

Route::post('/img', [ImgController::class, 'store']);

Route::get('/brands', [BrandController::class, 'all']);
Route::get('/brand', [BrandController::class, 'index']);
Route::post('/brand', [BrandController::class, 'store']);
Route::post('/brand/{id}', [BrandController::class, 'update']);
Route::delete('/brand/{id}', [BrandController::class, 'destroy']);