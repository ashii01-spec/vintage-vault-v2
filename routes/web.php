<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ------------------------------------ Authenticated Routes -----------------------------------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // admin routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/users', function () {
            return "Welcome Admin! Manage Users here.";
        })->name('admin.users');

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

// ----------------------------------------- Public Routes -----------------------------------------

// Landing Page ( Home Page )
Route::get('/', function () {
    return view('welcome'); // We will change this to our Vintage Vault Home later
});






