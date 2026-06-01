<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContentPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard',
        DashboardController::class
    )->name('dashboard');

    Route::resource(
        'content-pages',
        ContentPageController::class
    );

    Route::resource(
        'products',
        ProductController::class
    );

    Route::resource(
        'locations',
        LocationController::class
    );

    Route::get(
        'settings',
        [SettingController::class,'index']
    )->name('settings.index');

    Route::put(
        'settings',
        [SettingController::class,'update']
    )->name('settings.update');
});

require __DIR__.'/auth.php';