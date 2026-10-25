<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    protected $fillable = [
        'shop_id',
        'plan_id',
        'user_id',
        'status',
        'payment_provider',
        'payment_id',
        'type',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'trial_ends_at',
        'ends_at',
    ];

    public function scopeEntitled($query)
    {
        return $query->where('type', 'default')->whereHas('plan', fn ($p) => $p->where('is_active', true))
            ->where(function ($q) {
                $q->where(function ($free) {
                    // Legacy webhook code expired Free rows; Free itself has no paid expiry.
                    $free->where('payment_provider', 'free')->whereHas('plan', fn ($p) => $p->where('is_free', true)->where('price', 0));
                })->orWhere(function ($paid) {
                    $paid->where('payment_provider', 'stripe')->whereIn('stripe_status', ['active', 'trialing'])
                        ->where(fn ($end) => $end->whereNull('ends_at')->orWhere('ends_at', '>', now()))
                        ->whereHas('plan', fn ($p) => $p->where('is_free', false)->whereColumn('plans.stripe_price', 'subscriptions.stripe_price'));
                });
            });
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /** * Subscription belongs to a user. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
