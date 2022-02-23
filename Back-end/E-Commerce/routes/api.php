<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
    Route::get('/profile', [JWTController::class, 'profile']);
    Route::post('/profile/update', [JWTController::class, 'updateUserProfile']);
    Route::post('/profile/changepassword', [JWTController::class, 'changePassword']);
    Route::post('/profile/addwishlist', [JWTController::class, 'addToWishlist']);
    Route::get('/profile/wishlist/{user_id}', [JWTController::class, 'userWishlist']);
    Route::delete('/profile/deletewishlist/{id}', [JWTController::class, 'deleteFromWishlist']);
    Route::post('/placeorder', [JWTController::class, 'placeOrder']);
    Route::post('/registerorder', [JWTController::class, 'orderDetails']);
    Route::get('/myorders/{id}', [JWTController::class, 'userOrders']);
    Route::get('/getcoupon/{code}', [JWTController::class, 'getCoupon']);
    Route::get('/profile/usedcoupons/{id}', [JWTController::class, 'usedCoupon']);
    Route::get('/couponcount/{id}', [JWTController::class, 'couponCount']);
    Route::post('/trackorder', [JWTController::class, 'trackOrder']);
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

// all CMS Api
Route::get('/cms', [CMSController::class, 'getCMSsApi']);

// Single Cms api
Route::get('/cms/{slug}', [CMSController::class, 'getCMSApi']);

Route::get('/test',[ UserController::class, 'apiTEST']);