<?php

use App\Http\Controllers\FrontendDashboard\FrontendDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'frontend_dashboard', 'as' => 'frontend_dashboard.', 'middleware' => ['roles', 'role:frontend_dashboard']], function () {

    // Dashboard
    Route::get('/', [FrontendDashboardController::class, 'index'])->name('index2');
    Route::get('/index', [FrontendDashboardController::class, 'index'])->name('index');

    // Lock Screen
    Route::get('/lock-screen', [FrontendDashboardController::class, 'lock_screen'])->name('lock-screen');
    Route::post('/unlock', [FrontendDashboardController::class, 'unlock'])->name('unlock');

    // Layout & Profile
    Route::get('layout-customizer', [ProfileController::class, 'layoutCustomizer'])->name('profile.layout-customizer');
    Route::post('/user/layout-preferences', [ProfileController::class, 'updateModeFromRightBar'])->name('profile.updateModeFromRightBar');
    Route::post('/update-language-preference', [ProfileController::class, 'updateLanguagePreference'])->name('profile.updatelanguagepreference')->middleware(['auth']);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('admin/profile/remove-image', [ProfileController::class, 'remove_image'])->name('profile.remove_image');
    Route::patch('/profile', [ProfileController::class, 'update_profile'])->name('profile.update');
});
