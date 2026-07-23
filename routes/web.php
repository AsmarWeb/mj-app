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
use App\Http\Controllers\Admin\ProjectExplorerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShopsController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ListingCategoryController;
use App\Http\Controllers\PhoneVerificationController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\Seller\StripeConnectController;
use App\Http\Controllers\ShopCountryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\User\EditController;
use App\Http\Controllers\WishlistController;
use App\Livewire\Admin\Listing\CreateComponent;
use App\Models\Order;
use App\Mail\OrderPaidMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderPaidNotification;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])
    ->name('social.redirect');

Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
    ->name('social.callback');

Route::get('/sitemap', [SitemapController::class, 'page'])
    ->name('sitemap.page');

Route::get(
'/sitemap.xml',
[SitemapController::class,'index']
);


Route::get(
'/sitemap-pages.xml',
[SitemapController::class,'pages']
);


Route::get(
'/sitemap-products.xml',
[SitemapController::class,'products']
);


Route::get(
'/sitemap-shops.xml',
[SitemapController::class,'shops']
);


Route::get(
'/sitemap-developers.xml',
[SitemapController::class,'developers']
);

Route::get(
    '/sitemap-categories.xml',
    [SitemapController::class,'categories']
);

Route::middleware('auth')->group(function(){


    Route::get(
        '/developers',
        [DeveloperController::class,'index']
    )->name('developers.index');


    Route::get(
        '/developers/join',
        [DeveloperController::class,'create']
    )->name('developers.join');


    Route::post(
        '/developers',
        [DeveloperController::class,'store']
    )->name('developers.store');


    Route::get(
        '/developer/{id}',
        [DeveloperController::class,'show']
    )->name('developers.show');


});

Route::get('/', [HomeController::class, 'home'])->name('home');
// Route::get('/discover', [DiscoverController::class, 'discover'])->name('discover');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/category/{slug}',[ExploreController::class,'category'])->name('discover.category');
Route::get('/categories', [ListingCategoryController::class, 'index'])->name('categories');
Route::get('/countries', [ShopCountryController::class, 'index'])->name('countries');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::resource('users', UsersController::class)->only('show','edit','update')->middleware('auth');
// Route::resource('shop', ShopController::class)->only('show','edit','update')->middleware('auth');

Route::middleware(['auth', 'verified','phone.verified'])->group(function () {
    Route::get('/shop/create/{step?}', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop/create/{step}', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/shop/edit', [ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/shop/update', [ShopController::class, 'update'])->name('shop.update');
    
    Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop');
    Route::get('/creators', [ShopController::class, 'creators'])->name('shop.creators');

    Route::get('/shop/{slug}/business-card',[ShopController::class, 'downloadBusinessCard'])->name('shop.business-card');
    Route::get('/business-card/{slug}',[ShopController::class,'businessCard'])->name('shop.public');
    
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/{shop}/{section}/{category}/{subcategories}/{brand}/{listing}', [ExploreController::class, 'show'])->name('listing.show');
});

Route::get('/notifications/{notification}', function ($id) {

    $notification = auth()->user()
        ->notifications()
        ->findOrFail($id);

    if (!$notification->read_at) {
        $notification->markAsRead();
    }

    return redirect($notification->data['url'] ?? route('dashboard'));

})->name('notifications.read');

// Route::middleware(['auth', 'verified','prefix' => 'seller', 'phone.verified'])
//     ->group(function () {

//         Route::get('/create', CreateListing::class)
//             ->name('listing.create');

// });

Route::group(['namespace' => 'App\Livewire\Seller', 'prefix' => 'seller', 'middleware' => ['role:seller|administrator']], function () {
    Route::view('/create', 'listings.create')->name('seller.create');
});

Route::middleware(['auth', 'role:seller'])->group(function () {

    Route::get('/seller/stripe/connect', [StripeConnectController::class, 'connect'])
        ->name('seller.stripe.connect');

    Route::get('/seller/stripe/success', [StripeConnectController::class, 'success'])
        ->name('seller.stripe.success');

});

Route::middleware('auth')->group(function () {

    Route::get(
        '/seller/listing/{listing}/edit',
        [EditController::class,'edit']
    )
    ->name('seller.edit');


    Route::put(
        '/seller/listing/{listing}',
        [EditController::class,'update']
    )
    ->name('seller.listing.update');

});

Route::middleware('auth')->group(function () {

    Route::get('/connect/create', [ConnectController::class, 'createAccount'])
        ->name('connect.create');

    Route::get('/connect/success', [ConnectController::class, 'success'])
        ->name('connect.success');

    Route::get('/connect/refresh', [ConnectController::class, 'refresh'])
        ->name('connect.refresh');
});

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/{item}/increase', [CartController::class, 'increase'])
        ->name('cart.increase');

    Route::post('/cart/{item}/decrease', [CartController::class, 'decrease'])
        ->name('cart.decrease');

    Route::delete('/cart/{item}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

});

Route::middleware('auth')->group(function () {


    Route::get(
        '/checkout',
        [CheckoutController::class,'checkout']
    )
    ->name('checkout');



    Route::get(
        '/checkout/success/{order}',
        [CheckoutController::class,'success']
    )
    ->name('checkout.success');


});

Route::post(
    '/listing/{listing}/lead',
    [LeadController::class,'store']
)->name('lead.store');

Route::middleware('auth')->group(function(){

Route::post(
'/cart/add/{listing}',
[CartController::class,'add']
)
->name('cart.add');



Route::post(
'/wishlist/add/{listing}',
[WishlistController::class,'add']
)
->name('wishlist.add');


});

Route::middleware('auth')->group(function () {
    Route::view('/profile', 'profile')->name('profile');
});

Route::middleware('auth')->group(function () {

    Route::get('/phone/verify', [PhoneVerificationController::class, 'show'])
        ->name('phone.verify');

    Route::post('/phone/send', [PhoneVerificationController::class, 'send'])
        ->name('phone.send');

    Route::post('/phone/check', [PhoneVerificationController::class, 'check'])
        ->name('phone.check');

});

Route::post(
    '/stripe/webhook',
    [StripeWebhookController::class, 'handleWebhook']
);

Route::middleware('auth')->group(function(){

    Route::get('/pricing',
        [SubscriptionController::class,'index']
    )->name('plans.index');


    Route::post('/subscription/checkout/{plan}',
        [SubscriptionController::class,'checkout']
    )->name('subscription.checkout');

    Route::get('/subscription/success',
function(){

    return view('subscription.success');

})
->name('subscription.success');

});

Route::get('/bot', [BotController::class,'index'])->name('bot');
Route::post('/bot/chat', [BotController::class,'chat']);

// Route::view('/', 'pages.home')->name('home');
// Route::view('about', 'pages.about')->name('about');
Route::view('services', 'pages.services')->name('services');
Route::view('sell', 'pages.sell')->name('sell');
Route::view('contact-us', 'pages.contact')->name('contact');

// Route::view('create', 'shop.create')->name('shop.create');

// Route::get('/{users}/show', [ProfileController::class, 'show'])->name('profile');

// Route::resource('users', ProfileController::class);

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/{user}', function () {
//         return view('dashboard');
//     })->name('profile');
// });

Route::middleware([
    'auth:sanctum', 'role:seller|administrator',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [ShopController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/resumes/create', [ResumeController::class, 'create'])->name('resumes.create');
    Route::post('/resumes', [ResumeController::class, 'store'])->name('resumes.store');
    Route::get('/resumes/{id}/edit', [ResumeController::class, 'edit'])->name('resumes.edit');
    Route::put('/resumes/{id}', [ResumeController::class, 'update'])->name('resumes.update');
    Route::get('/resumes/{id}/pdf', [ResumeController::class, 'pdf'])->name('resumes.pdf');
    Route::delete('/resumes/{id}', [ResumeController::class, 'destroy'])->name('resumes.destroy');

    Route::get('/cv/{slug}', [ResumeController::class,'public'])->name('resume.public');
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => ['role:superadministrator|administrator']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', function () {
            return view('index');
        })->name('admin.dashboard');
    });

    Route::post('page/delete/{id}', [PageController::class, 'delete'])->name('page.delete');

    Route::post('page/deleteImage', [PageController::class, 'deleteImage'])->name('page.deleteImage');

    Route::post('shops/{shop}/verify', [ShopsController::class, 'verify'])->name('admin.shops.verify');

    Route::post('shops/{shop}/unverify', [ShopsController::class, 'unverify'])->name('admin.shops.unverify');
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

    Route::middleware(['auth'])->group(function () {

    Route::get('project-explorer',
        [ProjectExplorerController::class, 'index']
    )->name('project-explorer');

});
});
