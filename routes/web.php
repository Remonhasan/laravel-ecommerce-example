<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('layouts.frontend.index');
// });

// Visitor Routes
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/register', [RegisterController::class, 'index'])->name('register.page');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/login', [LoginController::class, 'index'])->name('login.page');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// caching data routes
Route::get('/cached-category/{name}', [CategoryController::class, 'showCachedCategory']);


// Authentication Routes
Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Category Routes 
        Route::prefix('category')->group(function () {
            Route::get('/list', [CategoryController::class, 'index'])->name('category.list');
            Route::get('/add', [CategoryController::class, 'add'])->name('category.add');
            Route::post('/add', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        });

        // Product Routes 
        Route::prefix('product')->group(function () {
            Route::get('/list', [ProductController::class, 'index'])->name('product.list');
            Route::get('/add', [ProductController::class, 'add'])->name('product.add');
            Route::post('/add', [ProductController::class, 'store'])->name('product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
            Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        });

        // Coupons Routes 
        Route::prefix('coupon')->group(function () {
            Route::get('/list', [CouponController::class, 'index'])->name('coupon.list');
            Route::get('/add', [CouponController::class, 'add'])->name('coupon.add');
            Route::post('/add', [CouponController::class, 'store'])->name('coupon.store');
            Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
            Route::post('/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
            Route::get('/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');
        });

         // Permission Routes 
         Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permission.list');
            Route::post('/update', [PermissionController::class, 'update'])->name('permission.update');
        });

        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('profile.list');
            Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        });
    });
});






