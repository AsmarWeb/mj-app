<?php

use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\MobileAuthController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Middleware\CatalogResponse;
use App\Http\Middleware\MobileAuthResponse;
use App\Http\Middleware\RequireMobileToken;
use App\Http\Resources\AuthUserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn (Request $request) => response()->json((new AuthUserResource($request->user()))->resolve($request)))
    ->middleware([MobileAuthResponse::class, 'auth:sanctum']);

Route::prefix('v1/auth')->name('api.v1.auth.')->middleware(MobileAuthResponse::class)->group(function () {
    Route::post('/register', [MobileAuthController::class, 'register'])->middleware('throttle:mobile-register')->name('register');
    Route::post('/login', [MobileAuthController::class, 'login'])->middleware('throttle:mobile-login')->name('login');
    Route::middleware(['auth:sanctum', RequireMobileToken::class, 'throttle:mobile-account'])->group(function () {
        Route::get('/me', [MobileAuthController::class, 'me'])->name('me');
        Route::post('/logout', [MobileAuthController::class, 'logout'])->name('logout');
        Route::get('/devices', [MobileAuthController::class, 'devices'])->name('devices');
        Route::delete('/devices/{device}', [MobileAuthController::class, 'revoke'])->whereNumber('device')->name('devices.revoke');
        Route::post('/email/verification-notification', [MobileAuthController::class, 'resendVerification'])
            ->middleware('throttle:mobile-verification')->name('verification.send');
    });
});

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
