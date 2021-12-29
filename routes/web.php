<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserrController;
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

Route::middleware('auth')->group(function() {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // User Controller 
    Route::get('/user-management/add-user', [UserrController::class, 'addUserForm'])->name('add-user');
    Route::post('/user-management/add', [UserrController::class, 'addUser']);
    Route::get('/user-management', [UserrController::class, 'getUsers'])->name('user-management');
    Route::get('/user-management/user/{id}', [UserrController::class, 'getUser']);
    Route::post('/user-management/edit/{id}', [UserrController::class, 'editUser']);
    Route::delete('/user-management/delete/{id}', [UserrController::class, 'deleteUser']);

    // Banner Controller 
    Route::get('/banner-management', [BannerController::class, 'getBanners'])->name('banner-management'); 
    Route::get('/banner-management/add-banner',[BannerController::class, 'addBannerForm'])->name('add-banner');
    Route::post('/banner-management/add', [BannerController::class, 'addBanner']);
    Route::delete('/banner-management/delete/{id}', [BannerController::class, 'deleteBanner']);
    Route::get('/banner-management/banner/{id}', [BannerController::class, 'getBanner']);
    Route::post('/banner-management/edit/{id}', [BannerController::class, 'editBanner']);

    // Category Controller
    Route::get('/category-management', [CategoryController::class, 'getCategories'])->name('category-management');

});