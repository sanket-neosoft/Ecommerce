<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// JWT Token Api
Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);
    Route::post('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [JWTController::class, 'refresh']);
    Route::post('/profile', [JWTController::class, 'profile']);
});

// All Banners Api
Route::get('/banners', [BannerController::class, 'getBannersApi']);

// Contact Us Api
Route::post('/contactus', [ContactUsController::class, 'contactUsApi']);

// All Products Api
Route::get('/products', [ProductController::class, 'getProductsApi']);

// All Categories Api
Route::get('/categories', [CategoryController::class, 'getCategoriesApi']);

// Product Detail Api
Route::get('/product/{id}', [ProductController::class,'getProductApi']);

// Category all Products Api
Route::get('/category/products/{id}', [CategoryController::class, 'getCategoryProductsApi']);
