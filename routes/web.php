<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShopsController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Livewire\Admin\Listing\CreateComponent;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::view('/', 'pages.home')->name('home');
    Route::view('about', 'pages.about')->name('about');
    Route::view('services', 'pages.services')->name('services');
    Route::view('demo', 'pages.demo')->name('demo');
    Route::view('contact-us', 'pages.contact')->name('contact');
});

Route::view('create', 'shop.create')->name('shop.create');

Route::get('/{user}', [ProfileController::class, 'show'])->name('profile');

Route::resource('users', ProfileController::class);


Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified',
])->group(function () {
    Route::get('/{user}/shop', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => ['role:superadministrator|administrator']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', function () {
            return view('index');
        })->name('admin.dashboard');
    });
});

Route::group(['namespace' => 'App\Livewire\Admin', 'prefix' => 'admin', 'middleware' => ['role:superadministrator|administrator']], function () {
    Route::get('/create', CreateComponent::class)->name('admin.create');
});


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'manage', 'middleware' => ['role:superadministrator|administrator']], function () {
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    Route::resource('shops', ShopsController::class);
    Route::resource('listings', ListingController::class);

    Route::resource('sections', SectionController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('brands', BrandController::class);

    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::resource('cities', CityController::class);

    Route::resource('settings', SettingController::class);
});
