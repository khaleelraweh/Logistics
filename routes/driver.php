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

    // Deliveries
    Route::resource('deliveries', DriverDeliveryController::class);
});
