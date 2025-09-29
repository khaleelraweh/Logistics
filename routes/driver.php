<?php

use App\Http\Controllers\Driver\DriverDashboardController;
use App\Http\Controllers\Driver\DeliveryController as DriverDeliveryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'driver', 'as' => 'driver.', 'middleware' => ['roles', 'role:driver']], function () {

    // Dashboard
    Route::get('/', [DriverDashboardController::class, 'index'])->name('index2');
    Route::get('/index', [DriverDashboardController::class, 'index'])->name('index');

    // Lock Screen
    Route::get('/lock-screen', [DriverDashboardController::class, 'lock_screen'])->name('lock-screen');
    Route::post('/unlock', [DriverDashboardController::class, 'unlock'])->name('unlock');


    // Profile & Settings
    Route::get('layout-customizer', [DriverDashboardController::class, 'layoutCustomizer'])->name('profile.layout-customizer');
    Route::post('/user/layout-preferences', [DriverDashboardController::class, 'updateModeFromRightBar'])->name('profile.updateModeFromRightBar');
    Route::post('/update-language-preference', [DriverDashboardController::class, 'updateLanguagePreference'])->name('profile.updatelanguagepreference')->middleware(['auth']);

    // Profile Management
    Route::get('/profile', [DriverDashboardController::class, 'profile'])->name('profile');
    Route::post('driver/profile/remove-image', [DriverDashboardController::class, 'remove_image'])->name('profile.remove_image');
    Route::patch('/profile', [DriverDashboardController::class, 'update_profile'])->name('profile.update');


    //Resources
    Route::resource('deliveries', DriverDeliveryController::class);
});
