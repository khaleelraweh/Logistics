<?php

use App\Http\Controllers\Driver\DriverDashboardController;
use App\Http\Controllers\Driver\DeliveryController as DriverDeliveryController;
use App\Http\Controllers\Driver\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'driver', 'as' => 'driver.', 'middleware' => ['roles', 'role:driver']], function () {

    // Dashboard
    Route::get('/', [DriverDashboardController::class, 'index'])->name('index2');
    Route::get('/index', [DriverDashboardController::class, 'index'])->name('index');

    // Lock Screen
    Route::get('/lock-screen', [DriverDashboardController::class, 'lock_screen'])->name('lock-screen');
    Route::post('/unlock', [DriverDashboardController::class, 'unlock'])->name('unlock');


    // Profile & Settings
    Route::get('layout-customizer', [ProfileController::class, 'layoutCustomizer'])->name('profile.layout-customizer');
    Route::post('/user/layout-preferences', [ProfileController::class, 'updateModeFromRightBar'])->name('profile.updateModeFromRightBar');
    Route::post('/update-language-preference', [ProfileController::class, 'updateLanguagePreference'])->name('profile.updatelanguagepreference')->middleware(['auth']);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('driver/profile/remove-image', [ProfileController::class, 'remove_image'])->name('profile.remove_image');
    Route::patch('/profile', [ProfileController::class, 'update_profile'])->name('profile.update');


    //Resources
    Route::resource('deliveries', DriverDeliveryController::class);
});
