<?php

namespace App\Providers;

use App\Models\Shop;
use App\Models\Subscription;
use App\Observers\ShopObserver;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::useSubscriptionModel(Subscription::class);
        Shop::observe(ShopObserver::class);
        \Illuminate\Support\Facades\RateLimiter::for('catalog', fn (\Illuminate\Http\Request $request) =>
            \Illuminate\Cache\RateLimiting\Limit::perMinute(max(1, min(1000, (int) config('catalog_api.rate_limit', 60))))->by('catalog:'.$request->ip()));
    }
}
