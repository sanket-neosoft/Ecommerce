<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // User Controller 
    Route::get('/user-management/add-user', [UserController::class, 'addUserForm'])->name('add-user');
    Route::post('/user-management/add', [Userontroller::class, 'addUser']);
    Route::get('/user-management', [UserController::class, 'getUsers'])->name('user-management');
    Route::get('/user-management/user/{id}', [UserController::class, 'getUser']);
    Route::post('/user-management/edit/{id}', [UserController::class, 'editUser']);
    Route::delete('/user-management/delete/{id}', [UserController::class, 'deleteUser']);

    // Banner Controller 
    Route::get('/banner-management', [BannerController::class, 'getBanners'])->name('banner-management');
    Route::get('/banner-management/add-banner', [BannerController::class, 'addBannerForm'])->name('add-banner');
    Route::post('/banner-management/add', [BannerController::class, 'addBanner']);
    Route::delete('/banner-management/delete/{id}', [BannerController::class, 'deleteBanner']);
    Route::get('/banner-management/banner/{id}', [BannerController::class, 'getBanner']);
    Route::post('/banner-management/edit/{id}', [BannerController::class, 'editBanner']);

    // Category Controller
    Route::get('/category-management', [CategoryController::class, 'getCategories'])->name('category-management');
    Route::get('/category-management/add-category', [CategoryController::class, 'addCategoryForm'])->name('add-category');
    Route::delete('/category-management/delete/{id}', [CategoryController::class, 'deleteCategory']);
    Route::post('category-management/add', [CategoryController::class, 'addCategory']);
    Route::get('/category-management/category/{id}', [BannerController::class, 'getCategory']);
    Route::get('/category-management/category/{id}', [CategoryController::class, 'getCategory']);
    Route::post('/category-management/edit/{id}', [CategoryController::class, 'editCategory']);

    // Product Controller
    Route::get('/product-management', [ProductController::class, 'getProducts'])->name('product-mangement');
    Route::get('/product-management/add-product', [ProductController::class, 'addProductForm'])->name('add-product');
    Route::post('/product-management/add', [ProductController::class, 'addProduct']);
    Route::delete('/product-management/delete/{id}', [ProductController::class, 'deleteProduct']);
    Route::get('/product-management/product-images/{id}', [ProductController::class, 'getProductImages'])->name('product-images');
    Route::get('/product-management/edit-product/{id}', [ProductController::class, 'editProduct'])->name('edit-product');
    Route::delete('/product-management/product-image/delete/{id}', [ProductController::class, 'deleteProductImage']);
    Route::post('/product-management/edit', [ProductController::class, 'editProductDetails']);

    // Configuration Controller 
    Route::get('/configuration-management', [ConfigController::class, 'getConfig'])->name('configuration-management');
    Route::post('/configuration-management/edit', [ConfigController::class, 'editConfig']);

    // Coupon Controller
    Route::get('/coupon-management', [CouponController::class, 'getCoupons'])->name('coupon-management');
    Route::get('/coupon-management/add-coupon', [CouponController::class, 'addCouponForm'])->name('add-coupon');
    Route::post('/coupon-management/add', [CouponController::class, 'addCoupon']);
    Route::delete('/coupon-management/delete/{id}', [CouponController::class, 'deleteCoupon']);
    Route::get('/coupon-management/coupon/{id}', [CouponController::class, 'getCoupon']);
    Route::post('/coupon-management/edit/{id}', [CouponController::class, 'editCoupon']);

    // UserOrder controller
    Route::get('/order-management', [UserOrderController::class, 'getOrders'])->name('order-management');
    Route::get('/order-management/order/{id}', [UserOrderController::class, 'getOrder']);
    Route::post('/order-management/edit/{id}', [UserOrderController::class, 'editOrder']);

    // CMS Controller
    Route::get('/cms-management', [CMSController::class, 'getCMSs'])->name('cms-management');
    Route::get('/cms-management/add-cms', [CMSController::class, 'addCMSForm'])->name('add-cms');
    Route::post('cms-management/add', [CMSController::class, 'addCMS']);
    Route::delete('/cms-management/delete/{id}', [CMSController::class, 'deleteCMS']);
    Route::get('/cms-management/cms/{id}', [CMSController::class, 'getCMS']);
    Route::post('/cms-management/edit/{id}', [CMSController::class, 'editCMS']);

    //PDFController
    Route::get('/download-products-pdf', [PDFController::class, 'downloadProducts']);
    Route::get('/download-users-pdf', [PDFController::class, 'downloadUsers']);
    Route::get('/download-coupons-pdf', [PDFController::class, 'downloadCoupons']);

    //ContactUsController
    Route::get('/inbox', [ContactUsController::class, 'getInbox']);
    Route::get('/inbox/{id}', [ContactUsController::class, 'readInbox']);
    Route::post('/send-reply', [ContactUsController::class, 'sendReply']);

});
