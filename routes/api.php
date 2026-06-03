<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ContentPageController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;

// Public routes (accessible from frontend without authentication)
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [CategoryController::class, 'show']);

Route::get('sub-categories', [SubCategoryController::class, 'index']);
Route::get('sub-categories/{id}', [SubCategoryController::class, 'show']);

Route::get('locations', [LocationController::class, 'index']);
Route::get('locations/{id}', [LocationController::class, 'show']);

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);

// Backward-compatible singular aliases
Route::get('location', [LocationController::class, 'index']);
Route::get('location/{id}', [LocationController::class, 'show']);
Route::get('product', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'show']);

Route::get('content-pages', [ContentPageController::class, 'index']);
Route::get('content-pages/{id}', [ContentPageController::class, 'show']);

// Public blog endpoints
Route::get('blogs', [BlogController::class, 'index']);
Route::get('blogs/{id}', [BlogController::class, 'show']);

Route::get('promotions', [PromotionController::class, 'index']);
Route::get('promotions/{id}', [PromotionController::class, 'show']);

// Backward-compatible singular blog aliases
Route::get('blog', [BlogController::class, 'index']);
Route::get('blog/{id}', [BlogController::class, 'show']);

// Authentication
Route::post('login', [AuthController::class, 'login']);

// Protected routes (authenticated admin only)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Settings
    Route::get('settings', [SettingsController::class, 'show']);
    Route::put('settings', [SettingsController::class, 'update']);

    // Existing resources
    Route::apiResource('banners', BannerController::class);
    Route::apiResource('pages', PageController::class);
    Route::post('blogs', [BlogController::class, 'store']);
    Route::put('blogs/{id}', [BlogController::class, 'update']);
    Route::delete('blogs/{id}', [BlogController::class, 'destroy']);

    Route::post('promotions', [PromotionController::class, 'store']);
    Route::put('promotions/{id}', [PromotionController::class, 'update']);
    Route::delete('promotions/{id}', [PromotionController::class, 'destroy']);

    Route::get('gallery', [GalleryController::class, 'index']);
    Route::post('gallery', [GalleryController::class, 'store']);
    Route::delete('gallery/{id}', [GalleryController::class, 'destroy']);

    Route::post('upload', [UploadController::class, 'upload']);
    Route::get('dashboard/stats', [DashboardController::class, 'stats']);

    // Category management (admin)
    Route::apiResource('categories', CategoryController::class);

    // Sub-Category management (admin)
    Route::apiResource('sub-categories', SubCategoryController::class);

    // Location management (admin)
    Route::post('locations', [LocationController::class, 'store']);
    Route::put('locations/{id}', [LocationController::class, 'update']);
    Route::delete('locations/{id}', [LocationController::class, 'destroy']);

    // Product management (admin)
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    // Content Pages management (admin)
    Route::post('content-pages', [ContentPageController::class, 'store']);
    Route::put('content-pages/{id}', [ContentPageController::class, 'update']);
    Route::delete('content-pages/{id}', [ContentPageController::class, 'destroy']);
});
