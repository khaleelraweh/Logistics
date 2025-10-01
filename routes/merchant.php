<?php

use App\Http\Controllers\Merchant\ProfileController;
use App\Http\Controllers\Merchant\MerchantDashboardController;
use App\Http\Controllers\Merchant\PackageController as MerchantPackageController;
use App\Http\Controllers\Merchant\PickupRequestController;
use App\Http\Controllers\Merchant\ProductController as MerchantProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'merchant', 'as' => 'merchant.', 'middleware' => ['roles', 'role:merchant']], function () {

    // Dashboard
    Route::get('/', [MerchantDashboardController::class, 'index'])->name('index2');
    Route::get('/index', [MerchantDashboardController::class, 'index'])->name('index');

    // Lock Screen
    Route::get('/lock-screen', [MerchantDashboardController::class, 'lock_screen'])->name('lock-screen');
    Route::post('/unlock', [MerchantDashboardController::class, 'unlock'])->name('unlock');

     // Profile & Settings
    Route::get('layout-customizer', [ProfileController::class, 'layoutCustomizer'])->name('profile.layout-customizer');
    Route::post('/user/layout-preferences', [ProfileController::class, 'updateModeFromRightBar'])->name('profile.updateModeFromRightBar');
    Route::post('/update-language-preference', [ProfileController::class, 'updateLanguagePreference'])->name('profile.updatelanguagepreference')->middleware(['auth']);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('driver/profile/remove-image', [ProfileController::class, 'remove_image'])->name('profile.remove_image');
    Route::patch('/profile', [ProfileController::class, 'update_profile'])->name('profile.update');


    // Packages
    Route::get('packages/create_for_good', [MerchantPackageController::class, 'create_for_good'])->name('packages.create_for_good');
    Route::post('packages/update-packages-status', [MerchantPackageController::class, 'updatePackageStatus'])->name('packages.update_packages_status');
    Route::post('package/remove-image', [MerchantPackageController::class, 'remove_image'])->name('packages.remove_image');
    Route::get('admin/packages/{id}/print', [MerchantPackageController::class, 'printPackage'])->name('packages.print');
    Route::resource('packages', MerchantPackageController::class);

    // Products
    Route::post('products/update-products-status', [MerchantProductController::class, 'updateProductstatus'])->name('products.update_merchants_status');
    Route::post('product/remove-image', [MerchantProductController::class, 'remove_image'])->name('products.remove_image');
    Route::resource('products', MerchantProductController::class);

    //pickupRequests / pickupRequests
    Route::resource('pickup_requests', PickupRequestController::class);
});
