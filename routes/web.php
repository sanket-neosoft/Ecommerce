<?php

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
    Route::get('/user-management/add-user', [UserManagement::class, 'addUserForm'])->name('add-user');
    Route::post('/user-management/add', [UserManagement::class, 'addUser'])->name('add');
    Route::get('/user-management', [UserManagement::class, 'getUsers'])->name('user-management');
});