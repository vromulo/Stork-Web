<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
// NEW: Import necessary controllers (You will need to create these)
use App\Http\Controllers\SellerController;
use App\Http\Controllers\LogisticsController;

// EXISTING: Home Page (Buyer Dashboard)
Route::get('/', [HomeController::class, 'index'])->name('home');

// EXISTING: Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
});

// Authenticated Routes (Only accessible when logged in)
Route::middleware('auth')->group(function () {
    // EXISTING
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // NEW: Seller Routes
    Route::get('pages/seller/seller-dashboard', [SellerController::class, 'index'])->name('seller.seller-dashboard');
    
    // NEW: Logistics Routes
    Route::get('pages/logistics/logistics-dashboard', [LogisticsController::class, 'index'])->name('logistics.logistics-dashboard');
});