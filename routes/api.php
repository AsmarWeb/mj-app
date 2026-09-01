<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\ShopController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| Shop API
|--------------------------------------------------------------------------
*/

Route::get('/shops', [ShopController::class, 'index']);

Route::get('/shops/{slug}', [ShopController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Listing API
|--------------------------------------------------------------------------
*/

Route::get('/listings', [ListingController::class, 'index']);

Route::get('/listings/{slug}', [ListingController::class, 'show']);
