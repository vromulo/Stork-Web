<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\LogisticsController;
use App\Http\Controllers\CategoryController;

// --------------------------------------------------------------------------

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Guest Admin Routes (Not fully logged in yet)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
        
        Route::get('/verify-login', [AdminAuthController::class, 'showOtpForm'])->name('otp.form');
        Route::post('/verify-login', [AdminAuthController::class, 'verifyOtp'])->name('otp.verify');
        Route::post('/verify-login/resend', [AdminAuthController::class, 'resendOtp'])->name('otp.resend');
    });

    // Protected Admin Routes (Requires authentication and admin role)
    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Placeholder for the dashboard
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    });
});

// --------------------------------------------------------------------------

// EXISTING: Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// NEW: Dynamic Category Route to avoid 404s
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

// EXISTING: Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
});

// --------------------------------------------------------------------------

// Authenticated Routes (Only accessible when logged in)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('pages/seller/seller-dashboard', [SellerController::class, 'index'])->name('seller.seller-dashboard');
    Route::get('pages/logistics/logistics-dashboard', [LogisticsController::class, 'index'])->name('logistics.logistics-dashboard');
});