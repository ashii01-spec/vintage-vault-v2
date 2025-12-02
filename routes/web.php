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

// Public Pages (Landing Page)
Route::get('/', function () {
    return view('welcome'); // We will change this to our Vintage Vault Home later
});

// Authenticated Users (Buyers, Sellers, Admin)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // General Dashboard for everyone
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ADMIN ONLY ROUTES
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/users', function () {
            return "Welcome Admin! Manage Users here.";
        })->name('admin.users');
        // We will add Product Management routes here later
    });

    // SELLER ONLY ROUTES
    Route::middleware(['role:seller'])->prefix('seller')->group(function () {
        Route::get('/products', function () {
            return "Welcome Seller! Manage your items here.";
        })->name('seller.products');
    });
});
