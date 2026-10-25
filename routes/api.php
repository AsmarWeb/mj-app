<?php

use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Middleware\CatalogResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn (Request $request) => $request->user())->middleware('auth:sanctum');

Route::middleware([CatalogResponse::class, 'throttle:catalog'])->group(function () {
    Route::prefix('v1')->name('api.v1.')->group(function () {
        Route::get('/openapi.json', fn () => response()->file(base_path('docs/catalog-api-openapi.json'), ['Content-Type' => 'application/json']))->name('openapi');
        Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
        Route::get('/shops/{slug}', [ShopController::class, 'show'])->name('shops.show');
        Route::get('/shops/{slug}/listings', [ListingController::class, 'forShop'])->name('shops.listings');
        Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
        Route::get('/listings/{slug}', [ListingController::class, 'show'])->name('listings.show');
    });
    // Compatibility routes use the same visibility, safe serializers, pagination and shared rate budget.
    Route::get('/shops', [ShopController::class, 'index']);
    Route::get('/shops/{slug}', [ShopController::class, 'show']);
    Route::get('/listings', [ListingController::class, 'index']);
    Route::get('/listings/{slug}', [ListingController::class, 'show']);
});
