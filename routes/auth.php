<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Merchant\MerchantDashboardController;
use App\Http\Controllers\Driver\DriverDashboardController;
use App\Http\Controllers\FrontendDashboard\FrontendDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

// Routes للضيف (غير المسجل دخوله)
Route::group(['middleware' => 'guest'], function () {
    // Admin auth routes
    Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
    Route::get('/admin/recover-password', [AdminController::class, 'recover_password'])->name('admin.recover-password');

    // Merchant auth routes
    Route::get('/merchant/login', [MerchantDashboardController::class, 'login'])->name('merchant.login');
    Route::get('/merchant/register', [MerchantDashboardController::class, 'register'])->name('merchant.register');
    Route::get('/merchant/recover-password', [MerchantDashboardController::class, 'recover_password'])->name('merchant.recover-password');

    // Driver auth routes
    Route::get('/driver/login', [DriverDashboardController::class, 'login'])->name('driver.login');
    Route::get('/driver/register', [DriverDashboardController::class, 'register'])->name('driver.register');
    Route::get('/driver/recover-password', [DriverDashboardController::class, 'recover_password'])->name('driver.recover-password');

    // Frontend Dashboard auth routes
    Route::get('/frontend_dashboard/login', [FrontendDashboardController::class, 'login'])->name('frontend_dashboard.login');
    Route::get('/frontend_dashboard/register', [FrontendDashboardController::class, 'register'])->name('frontend_dashboard.register');
    Route::get('/frontend_dashboard/recover-password', [FrontendDashboardController::class, 'recover_password'])->name('frontend_dashboard.recover-password');
});
