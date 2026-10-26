<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDeveloperController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DigitalProductController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LeadsController;
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
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ListingCategoryController;
use App\Http\Controllers\PhoneVerificationController;
use App\Http\Controllers\PodDigitalCheckoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Raslo\RasloSettingsController;
use App\Http\Controllers\Raslo\RasloWebhookController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Seller\StripeConnectController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopCountryController;
use App\Http\Controllers\ShopFollowController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SupplierDashboardController;
use App\Http\Controllers\SupplierInvitationController;
use App\Http\Controllers\User\EditController;
use App\Http\Controllers\WishlistController;
use App\Livewire\Admin\Listing\CreateComponent;
use Illuminate\Support\Facades\Route;

Route::view('/search', 'pages.search')->name('search');

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
    [SitemapController::class, 'index']
);

Route::get(
    '/sitemap-pages.xml',
    [SitemapController::class, 'pages']
);

Route::get(
    '/sitemap-products.xml',
    [SitemapController::class, 'products']
);

Route::get(
    '/sitemap-shops.xml',
    [SitemapController::class, 'shops']
);

Route::get(
    '/sitemap-developers.xml',
    [SitemapController::class, 'developers']
);

Route::get(
    '/sitemap-categories.xml',
    [SitemapController::class, 'categories']
);

Route::middleware('auth')->group(function () {

    Route::get(
        '/developers',
        [DeveloperController::class, 'index']
    )->name('developer.index');

    Route::get(
        '/developer/join',
        [DeveloperController::class, 'create']
    )->name('developer.join');

    Route::post(
        '/developers',
        [DeveloperController::class, 'store']
    )->name('developer.store');

    Route::get(
        '/developer/{username}',
        [DeveloperController::class, 'show']
    )->name('developer.show');
});

Route::middleware('maintenance.check')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
});

// Route::get('/discover', [DiscoverController::class, 'discover'])->name('discover');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/explore/category/{category}', [ExploreController::class, 'category'])->name('discover.category');
Route::get('/explore/section/{section}', [ExploreController::class, 'section'])->name('explore.section');
Route::get('/uae', [ExploreController::class, 'uae'])->name('uae');
Route::get('/categories', [ListingCategoryController::class, 'index'])->name('categories');
Route::get('/countries', [ShopCountryController::class, 'index'])->name('countries');
Route::get('about', [HomeController::class, 'about'])->name('about');
// Route::resource('shop', ShopController::class)->only('show','edit','update')->middleware('auth');

Route::middleware(['auth', 'verified', 'phone.verified'])->group(function () {
    Route::get('/shop/create/{step?}', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop/create/{step}', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/shop/edit', [ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/shop/update', [ShopController::class, 'update'])->name('shop.update');

    Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop');
    Route::get('/creators', [ShopController::class, 'creators'])->name('shop.creators');

    Route::get('/shop/{slug}/business-card', [ShopController::class, 'downloadBusinessCard'])->name('shop.business-card');
    Route::get('/business-card/{slug}', [ShopController::class, 'businessCard'])->name('shop.public');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/{shop}/{section}/{category}/{subcategories}/{brand}/{listing}', [ExploreController::class, 'show'])->name('listing.show');
});

Route::post('/ai/shop-description', [AIController::class, 'shopDescription'])
    ->name('ai.shop-description');

Route::middleware('auth')->group(function () {

    Route::get(
        '/posts',
        [PostController::class, 'index']
    )->name('posts.index');

    Route::post(
        '/posts',
        [PostController::class, 'store']
    )->name('posts.store');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');

    Route::post(
        '/posts/{post}/like',
        [LikeController::class, 'store']
    )->name('posts.like');

    Route::post(
        '/posts/{post}/comment',
        [CommentController::class, 'store']
    )->name('comments.store');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

Route::middleware('auth')->group(function () {

    Route::post(
        '/listing/{listing}/review',
        [ReviewController::class, 'store']
    )
        ->name('review.store');

    Route::middleware('auth')->post(
        '/shops/{shop}/follow',
        [ShopFollowController::class, 'toggle']
    )->name('shops.follow');
});

Route::get('/notifications/{notification}', function ($id) {

    $notification = auth()->user()
        ->notifications()
        ->findOrFail($id);

    if (! $notification->read_at) {
        $notification->markAsRead();
    }

    return redirect($notification->data['url'] ?? route('dashboard'));
})->middleware('auth')->name('notifications.read');

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
        [EditController::class, 'edit']
    )
        ->name('seller.edit');

    Route::put(
        '/seller/listing/{listing}',
        [EditController::class, 'update']
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

    Route::post('/checkout/{order}/resume', [CheckoutController::class, 'resume'])->middleware('throttle:10,1')->name('checkout.resume');
    Route::post('/checkout/{order}/cancel', [CheckoutController::class, 'cancel'])->middleware('throttle:10,1')->name('checkout.cancel');
    Route::post('/checkout', [CheckoutController::class, 'store'])->middleware('throttle:10,1')->name('checkout.store');

    Route::get(
        '/checkout',
        [CheckoutController::class, 'checkout']
    )
        ->name('checkout');

    Route::get(
        '/checkout/success/{order}',
        [CheckoutController::class, 'success']
    )
        ->name('checkout.success');
});

Route::middleware('auth')->group(function () {

    Route::post('/checkout/pod-digital', [PodDigitalCheckoutController::class, 'checkout'])
        ->name('pod.checkout');

    Route::get('/checkout/pod-digital/success', [PodDigitalCheckoutController::class, 'success'])
        ->name('pod.checkout.success');

    Route::get('/checkout/pod-digital/cancel', [PodDigitalCheckoutController::class, 'cancel'])
        ->name('pod.checkout.cancel');
});

Route::post(
    '/listing/{listing}/lead',
    [LeadController::class, 'store']
)->name('lead.store');

Route::middleware('auth')->group(function () {

    Route::post(
        '/cart/add/{listing}',
        [CartController::class, 'add']
    )
        ->name('cart.add');

    Route::post(
        '/wishlist/add/{listing}',
        [WishlistController::class, 'add']
    )
        ->name('wishlist.add');
});

Route::middleware('auth')->group(function () {
    Route::view('/profile', 'profile')->name('profile');
});

Route::get(
    '/supplier/invitation/{token}',
    [SupplierInvitationController::class, 'accept']
)->name('supplier.invitation');

Route::post(
    '/supplier/invitation/{token}',
    [SupplierInvitationController::class, 'store']
)->name('supplier.invitation.store');

Route::middleware(['auth', 'supplier', 'role:supplier'])->prefix('supplier')->name('supplier.')->group(function () {

    Route::get(
        '/dashboard',
        [
            SupplierDashboardController::class,
            'index',
        ]
    )
        ->name('dashboard');

    Route::get(
        '/products',
        function () {

            return view(
                'supplier.products.index'
            );
        }
    )
        ->name('products.index');

    Route::get(
        '/orders',
        function () {

            return view(
                'supplier.orders.index'
            );
        }
    )
        ->name('orders.index');

    Route::get(
        '/payouts',
        function () {

            return view(
                'supplier.payouts.index'
            );
        }
    )
        ->name('payouts.index');
});

Route::middleware('auth')->group(function () {

    Route::get('/phone/verify', [PhoneVerificationController::class, 'show'])
        ->name('phone.verify');

    Route::post('/phone/send', [PhoneVerificationController::class, 'send'])
        ->middleware('throttle:phone-send')->name('phone.send');

    Route::post('/phone/check', [PhoneVerificationController::class, 'check'])
        ->middleware('throttle:phone-check')->name('phone.check');
});

Route::post(
    '/stripe/webhook',
    [StripeWebhookController::class, 'handleWebhook']
);

Route::middleware('auth')->group(function () {

    Route::get(
        '/pricing',
        [SubscriptionController::class, 'index']
    )->name('plans.index');

    Route::post(
        '/subscription/checkout/{plan}',
        [SubscriptionController::class, 'checkout']
    )->name('subscription.checkout');

    Route::post('/subscription/portal', [SubscriptionController::class, 'portal'])->name('subscription.portal');

    Route::get(
        '/subscription/success',
        [SubscriptionController::class, 'success']
    )
        ->name('subscription.success');
});

Route::get('/bot', [BotController::class, 'index'])->name('bot');
Route::post('/bot/chat', [BotController::class, 'chat']);

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
    'auth:sanctum',
    'role:seller|administrator',
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

    Route::get('/cv/{slug}', [ResumeController::class, 'public'])->name('resume.public');
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

    Route::post(
        'listings/{listing}/featured',
        [ListingController::class, 'featured']
    )->name('listings.featured');

    Route::post(
        'listings/{listing}/unfeatured',
        [ListingController::class, 'unfeatured']
    )->name('listings.unfeatured');
});

Route::group(['namespace' => 'App\Livewire\Admin', 'prefix' => 'admin', 'middleware' => ['role:superadministrator|administrator']], function () {
    Route::get('/create', CreateComponent::class)->name('admin.create');

    Route::get(
        'digital-products',
        [DigitalProductController::class, 'index']
    )
        ->name('digital-products.index');

    Route::get(
        '/digital-products/create',
        [DigitalProductController::class, 'create']
    )
        ->name('digital-products.create');

    Route::post(
        '/digital-products',
        [DigitalProductController::class, 'store']
    )
        ->name('digital-products.store');
});

Route::middleware('auth')->group(function () {

    Route::get(
        '/digital-products/{slug}/download',
        [DigitalProductController::class, 'download']
    )->name('digital-products.download');

    Route::middleware('auth')->post(
        '/digital-products/{slug}/checkout',
        [PodDigitalCheckoutController::class, 'checkoutProduct']
    )->name('digital-products.checkout');

    Route::get(
        '/digital-products/{slug}/success',
        [PodDigitalCheckoutController::class, 'successProduct']
    )->name('digital-products.success');

    Route::middleware('auth')->get(
        '/downloads/{token}',
        [DownloadController::class, 'download']
    )->name('downloads.download');

    Route::get(
        '/digital-products/{slug}',
        [DigitalProductController::class, 'show']
    )->name('digital-products.show');
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

        Route::get(
            'project-explorer',
            [ProjectExplorerController::class, 'index']
        )->name('project-explorer');

        Route::resource('leads', LeadsController::class);

        Route::resource(
            'invoices',
            InvoiceController::class
        );

        Route::get(
            'invoices/{invoice}/download',
            [
                InvoiceController::class,
                'download',
            ]
        )
            ->name('invoices.download');

        Route::post(
            'invoices/{invoice}/status',
            [
                InvoiceController::class,
                'updateStatus',
            ]
        )
            ->name('invoices.status');
    });

    Route::resource('suppliers', SupplierController::class);

    Route::get('/developers', [AdminDeveloperController::class, 'index'])
        ->name('developers.index');

    Route::get('/developers/{developer}', [AdminDeveloperController::class, 'show'])
        ->name('developers.show');

    Route::get('/developers/{developer}/edit', [AdminDeveloperController::class, 'edit'])
        ->name('developers.edit');

    Route::put('/developers/{developer}', [AdminDeveloperController::class, 'update'])
        ->name('developers.update');

    Route::patch('/developers/{developer}/approve', [AdminDeveloperController::class, 'approve'])
        ->name('developers.approve');

    Route::patch('/developers/{developer}/reject', [AdminDeveloperController::class, 'reject'])
        ->name('developers.reject');

    Route::delete('/developers/{developer}', [AdminDeveloperController::class, 'destroy'])
        ->name('developers.destroy');
});

Route::middleware(['auth', 'verified', 'phone.verified', 'role:seller|administrator'])->group(function () {
    Route::get('/seller/raslo', [RasloSettingsController::class, 'show'])->name('raslo.settings');
    Route::post('/seller/raslo', [RasloSettingsController::class, 'update'])->middleware('throttle:10,1')->name('raslo.settings.update');
    Route::post('/seller/raslo/orders/{order}/retry', [RasloSettingsController::class, 'retry'])->middleware('throttle:10,1')->name('raslo.retry');
});
Route::get('/orders/{order}/delivery', [RasloSettingsController::class, 'tracking'])->middleware('auth')->name('raslo.tracking');
Route::post('/integrations/raslo/events/{connection}', RasloWebhookController::class)->middleware('throttle:120,1')->name('raslo.events');

Route::get('/my-deliveries', [RasloSettingsController::class, 'deliveries'])->middleware('auth')->name('raslo.my-deliveries');
