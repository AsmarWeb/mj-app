<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements LaratrustUser, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRolesAndPermissions;
    use HasSlug;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'password',
        'phone_verified_at',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('username');
    }

    public function shop(): HasOne
    {
        return $this->hasOne(Shop::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function listing(): HasMany
    {
        return $this->hasMany(Listing::class)->latest();
    }

    public function downloads()
    {
    return $this->hasMany(\App\Models\Download::class);
    }

    public function orders(): HasMany
    {
    return $this->hasMany(Order::class);
    }

    public function businessCards(): HasMany
    {
        return $this->hasMany(BusinessCard::class);
    }

    public function payments()
    {
    return $this->hasMany(Payment::class);
    }

    public function resumes()
    {
    return $this->hasMany(Resume::class);
    }

    public function cart()
    {
    return $this->hasOne(Cart::class);
    }

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

    public function wishlists(){
    return $this->hasMany(Wishlist::class);
    }

    public function cartItems()
    {
    return $this->hasMany(CartItem::class);
    }

    public function coupons()
    {
    return $this->belongsToMany(Coupon::class)
        ->withPivot('payment_id', 'discount_amount')
        ->withTimestamps();
    }

    public function followedShops()
    {
        return $this->belongsToMany(Shop::class, 'shop_followers')->withTimestamps();
    }

    public function hasVerifiedPhone(): bool
    {
    return ! is_null($this->phone_verified_at);
    }
    
    public function markPhoneAsVerified(): bool
    {
    return $this->forceFill([
        'phone_verified_at' => now(),
    ])->save();
    }

    public function storageUsed()
    {
    return $this->listings()
        ->sum(function ($listing) {

            $size = 0;

            // Main image
            if ($listing->image) {

                $path = storage_path(
                    'app/public/products/'.$listing->image
                );

                if (file_exists($path)) {
                    $size += filesize($path);
                }
            }


            // Gallery images
            if ($listing->images) {

                foreach ($listing->images as $image) {

                    $path = storage_path(
                        'app/public/products/'.$image
                    );

                    if (file_exists($path)) {
                        $size += filesize($path);
                    }
                }
            }


            return $size;

        });
    }

    public function storageUsedMB()
    {
    return round($this->storageUsed() / 1024 / 1024, 2);
    }
}
