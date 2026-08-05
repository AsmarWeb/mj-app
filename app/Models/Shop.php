<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Stripe\Account;

class Shop extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'shops';

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'logo',
        'banner',
        'type',
        'description',
        'location',
        'latitude',
        'longitude',
        'section_id',
        'country_id',
        'state_id',
        'city_id',
        'rating',
        'published_at',
        'user_id',
        'step',
        'is_completed',
        'is_active',
        'verified',
        'verified_at',
        'verified_by',
        'phone',
        'whatsapp',
        'allow_phone',
        'allow_whatsapp',
        'stripe_account_id',
        'stripe_connected',
    ];

    protected $dates = ['published_at'];

    protected $casts = [
        'verified' => 'boolean',
        'verified_at' => 'datetime',
        'published_at' => 'datetime',
        'rating' => 'float',
    ];

    protected static function booted()
    {
        static::created(function ($shop) {

            $shop->wallet()->create([
                'available_balance' => 0,
                'pending_balance' => 0,
                'total_earned' => 0,
            ]);

        });
    }

    public function isVerified()
    {
        return $this->verified;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'shop_id', 'id');
    }

    public function digitalProduct(): HasMany
    {
        return $this->hasMany(DigitalProduct::class, 'shop_id', 'id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function businessCard()
    {
        return $this->hasOne(BusinessCard::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->latestOfMany();
    }

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>', Carbon::now());
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::now();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'shop_followers')->withTimestamps();
    }

    public function ratings()
    {
        return $this->hasMany(ShopRating::class);
    }

    public function canReceiveOrder()
    {
        // No plan = no orders
        if (! $this->plan) {
            return false;
        }

        // Unlimited orders
        if ($this->plan->order_limit == 0) {
            return true;
        }

        $ordersThisPeriod = $this->orders()
            ->whereIn('status', [
                'processing',
                'completed',
            ])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return $ordersThisPeriod < $this->plan->order_limit;
    }

    public function stripeReady()
    {
        $account = Account::retrieve(
            $this->stripe_account_id
        );

        return
            $account->charges_enabled &&
            $account->payouts_enabled;
    }
}
