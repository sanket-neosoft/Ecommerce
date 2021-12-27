<?php

use App\Http\Controllers\BannerManagement;
use App\Http\Controllers\CategoryManagement;
use App\Http\Controllers\UserManagement;
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
    Route::get('/user-management/add-user', [UserManagement::class, 'addUserForm'])->name('add-user');
    Route::post('/user-management/add', [UserManagement::class, 'addUser']);
    Route::get('/user-management', [UserManagement::class, 'getUsers'])->name('user-management');

    // Banner Controller 
    Route::get('/banner-management', [BannerManagement::class, 'getBanners'])->name('banner-management'); 
    Route::get('/banner-management/add-banner',[BannerManagement::class, 'addBannerForm'])->name('add-banner');
    Route::post('/banner-management/add', [BannerManagement::class, 'addBanner']);

    // Category Controller
    Route::get('/category-management', [CategoryManagement::class, 'getCategories'])->name('category-management');
});