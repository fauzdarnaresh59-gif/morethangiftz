<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::post('/newsletter/subscribe', [App\Http\Controllers\HomeController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

// Authentication Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Account Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    Route::get('/account/orders', [App\Http\Controllers\AccountController::class, 'orders'])->name('account.orders');
    Route::get('/account/quotes', [App\Http\Controllers\AccountController::class, 'quotes'])->name('account.quotes');
    Route::get('/account/wishlist', [App\Http\Controllers\AccountController::class, 'wishlist'])->name('account.wishlist');
    Route::get('/account/addresses', [App\Http\Controllers\AccountController::class, 'addresses'])->name('account.addresses');
    Route::get('/account/settings', [App\Http\Controllers\AccountController::class, 'settings'])->name('account.settings');
});
