<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\LocaleController as AdminLocaleController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/index', [FrontendController::class, 'index'])->name('frontend.index');

// Language Change
Route::get('/change-language/{locale}', [AdminLocaleController::class, 'switch'])->name('change.language');

// PDF Download
Route::get('/download-pdf/{filename}', function ($filename) {
    $pathToFile = public_path('assets/document_archives/' . $filename);

    if (!file_exists($pathToFile)) {
        abort(404, 'File not found');
    }

    $downloadName = 'custom_' . $filename;
    return response()->download($pathToFile, $downloadName);
});
