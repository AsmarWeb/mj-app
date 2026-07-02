<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShopsController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AiBuilderController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\BusinessCardController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Livewire\Admin\Listing\CreateComponent;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/discover', [DiscoverController::class, 'discover'])->name('discover');
Route::get('/discover/category/{category}', [DiscoverController::class, 'category'])->name('discover.category');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::resource('users', UsersController::class)->only('show','edit','update')->middleware('auth');
// Route::resource('shop', ShopController::class)->only('show','edit','update')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/shop/create', [ShopController::class, 'create']);
    Route::post('/shop', [ShopController::class, 'store']);
    Route::get('/shop/{shop}', [ShopController::class, 'show'])->name('shop');

    Route::get('/listing/{listing}', [ListingController::class, 'show'])->name('listing.show');
});

Route::get('/bot', [BotController::class,'index'])->name('bot');
Route::post('/bot/chat', [BotController::class,'chat']);

// Route::view('/', 'pages.home')->name('home');
// Route::view('about', 'pages.about')->name('about');
Route::view('services', 'pages.services')->name('services');
Route::view('sell', 'pages.sell')->name('sell');
Route::view('contact-us', 'pages.contact')->name('contact');

Route::view('create', 'shop.create')->name('shop.create');

// Route::get('/{users}/show', [ProfileController::class, 'show'])->name('profile');

// Route::resource('users', ProfileController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/{user}', function () {
        return view('profile');
    })->name('profile');
});

Route::middleware('auth')->group(function(){

    Route::get(
        '/business-card/create',
        [BusinessCardController::class,'create']
    );


    Route::post(
        '/business-card',
        [BusinessCardController::class,'store']
    );


    Route::get(
        '/business-card/{id}/pdf',
        [BusinessCardController::class,'pdf']
    )
    ->name('cards.pdf');

});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => ['role:superadministrator|administrator']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', function () {
            return view('index');
        })->name('admin.dashboard');
    });

    Route::post('page/delete/{id}', [PageController::class, 'delete'])->name('page.delete');

    Route::post('page/deleteImage', [PageController::class, 'deleteImage'])->name('page.deleteImage');
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

    Route::resource('features', FeatureController::class);

    Route::resource('services', ServiceController::class);

    Route::resource('pages', PageController::class);

    Route::resource('subscribers', SubscriberController::class);
    Route::resource('contacts', ContactController::class);
});
