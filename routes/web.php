<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;

// ----------------------------------------- Public Routes -----------------------------------------

// Landing Page ( Home Page )
Route::get('/', [HomeController::class, 'index'])->name('home');




// ------------------------------------ Authenticated Routes -----------------------------------

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // ADMIN ROUTES
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    
        // CRUD Routes (Standard Resource Routes)
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
    });
    
    // General Dashboard for everyone
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Cart Page
    Route::get('/cart', \App\Livewire\CartIndex::class)->name('cart');

    // Shop Page
    Route::get('/shop', \App\Livewire\ShopIndex::class)->name('shop');


    // Seller routes
    Route::middleware(['role:seller'])->prefix('seller')->group(function () {
        Route::get('/products', function () {
            return "Welcome Seller! Manage your items here.";
        })->name('seller.products');
    });
});








