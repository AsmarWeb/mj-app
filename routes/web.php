<?php

use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('about', 'pages.about')->name('about');
Route::view('services', 'pages.services')->name('services');
Route::view('demo', 'pages.demo')->name('demo');

Route::get('/{user}', [ProfileController::class, 'show'])->name('profile');

Route::resource('users', ProfileController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
