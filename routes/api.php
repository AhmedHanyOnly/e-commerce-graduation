<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::post('products/addToCart/{product}', [ProductController::class, 'addToCart']);
Route::post('products_filter', [ProductController::class, 'filter']);
Route::get('/cart_count', [ProductController::class, 'cart_count']);
Route::get('filters', [ProductController::class, 'productFilters']);

Route::post('products/addToFavourite/{product}', \App\Http\Controllers\Api\FavouriteController::class);
