<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtisanAuthController;
use App\Http\Controllers\ArtisanEmailVerificationController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\BillingDestinationController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\UnitPriceController;
use App\Http\Controllers\TaxRateController;
use App\Http\Controllers\OrderController;

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
    
    Route::resource('customers', CustomerController::class);
    Route::post('/customers/sort-order', [CustomerController::class, 'updateSortOrder'])->name('customers.sort-order');
    Route::resource('artisans', ArtisanController::class);
    Route::resource('billing_destinations', BillingDestinationController::class);
    
    Route::resource('operations', OperationController::class);
    Route::post('/operations/sort-order', [OperationController::class, 'updateSortOrder'])->name('operations.sort-order');
    
    Route::get('/unit-prices', [UnitPriceController::class, 'index'])->name('unit-prices.index');
    Route::get('/unit-prices/operations', [UnitPriceController::class, 'getOperationsByCustomer'])->name('unit-prices.operations');
    Route::post('/unit-prices', [UnitPriceController::class, 'store'])->name('unit-prices.store');
    
    Route::resource('orders', OrderController::class);
    Route::get('/orders/api/billing-destinations/search', [OrderController::class, 'searchBillingDestinations'])->name('orders.api.billing-destinations.search');
    Route::get('/orders/api/properties/{billingDestinationId}', [OrderController::class, 'getPropertiesByBillingDestination'])->name('orders.api.properties');
    Route::get('/orders/api/operations/search', [OrderController::class, 'searchOperations'])->name('orders.api.operations.search');
    Route::get('/orders/api/artisans/search', [OrderController::class, 'searchArtisans'])->name('orders.api.artisans.search');
    Route::get('/orders/api/unit-prices/{customerId}', [OrderController::class, 'getUnitPricesByCustomer'])->name('orders.api.unit-prices');
    
    Route::resource('users', UserController::class);
    Route::resource('tax-rates', TaxRateController::class)->except(['show']);
    
    Route::get('/company-info/edit', [CompanyInfoController::class, 'edit'])->name('company-info.edit');
    Route::put('/company-info', [CompanyInfoController::class, 'update'])->name('company-info.update');
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
