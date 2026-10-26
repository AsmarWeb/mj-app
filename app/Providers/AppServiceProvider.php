<?php

namespace App\Providers;

use App\Models\Shop;
use App\Models\Subscription;
use App\Observers\ShopObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        // Separate account and IP budgets limit SMS spending and verification attempts.
        RateLimiter::for('phone-send', fn (Request $request) => [
            Limit::perMinute(3)->by('phone-send-user:'.$request->user()->id),
            Limit::perHour(10)->by('phone-send-hour:'.$request->user()->id),
            Limit::perMinute(10)->by('phone-send-ip:'.$request->ip()),
        ]);
        RateLimiter::for('phone-check', fn (Request $request) => [
            Limit::perMinute(5)->by('phone-check-user:'.$request->user()->id),
            Limit::perMinute(20)->by('phone-check-ip:'.$request->ip()),
        ]);

        Cashier::useSubscriptionModel(Subscription::class);
        Shop::observe(ShopObserver::class);
        RateLimiter::for('catalog', fn (Request $request) => Limit::perMinute(max(1, min(1000, (int) config('catalog_api.rate_limit', 60))))->by('catalog:'.$request->ip()));
    }
}
