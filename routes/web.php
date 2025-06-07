<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtisanAuthController;
use App\Http\Controllers\ArtisanEmailVerificationController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/password/reset', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::prefix('artisan')->group(function () {
    Route::get('/login', [ArtisanAuthController::class, 'showLoginForm'])->name('artisan.login');
    Route::post('/login', [ArtisanAuthController::class, 'login']);
    Route::post('/logout', [ArtisanAuthController::class, 'logout'])->name('artisan.logout');
    
    Route::get('/register', [ArtisanAuthController::class, 'showRegistrationForm'])->name('artisan.register');
    Route::post('/register', [ArtisanAuthController::class, 'register']);
    
    Route::get('/email/verify', [ArtisanEmailVerificationController::class, 'notice'])->name('artisan.verification.notice');
    Route::get('/email/verify/{token}', [ArtisanEmailVerificationController::class, 'verify'])->name('artisan.verification.verify');
    Route::post('/email/resend', [ArtisanEmailVerificationController::class, 'resend'])->name('artisan.verification.resend');
    
    Route::get('/password/reset', [ArtisanAuthController::class, 'showResetForm'])->name('artisan.password.request');
    Route::post('/password/email', [ArtisanAuthController::class, 'sendResetLinkEmail'])->name('artisan.password.email');
    Route::get('/password/reset/{token}', [ArtisanAuthController::class, 'showResetPasswordForm'])->name('artisan.password.reset');
    Route::post('/password/reset', [ArtisanAuthController::class, 'resetPassword'])->name('artisan.password.update');
});

Route::middleware('auth:artisan')->group(function () {
    Route::get('/artisan_dashboard', [ArtisanAuthController::class, 'dashboard'])->name('artisan.dashboard');
});
