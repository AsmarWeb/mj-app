<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'whatsapp',

        // UAE
        'address',
        'country',
        'emirate',
        'vat_number',

        // Supplier
        'supplier_type',
        'type',

        // Website / Integration
        'website',
        'api_key',

        // Marketplace
        'commission',

        // Status
        'status',

        // Invitation
        'invite_token',
        'user_id',
        'invited_at',
    ];

    protected $casts = [
        'commission' => 'decimal:2',
        'invited_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Products belonging to this supplier.
     *
     * Currently your POD products are stored in DigitalProduct.
     */
    public function products(): HasMany
    {
        return $this->hasMany(DigitalProduct::class)
            ->where('type', 'pod');
    }


    /**
     * Supplier payouts.
     */
    public function payouts(): HasMany
    {
        return $this->hasMany(SupplierPayout::class);
    }


    /**
     * User account associated with this supplier.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Supplier wallet.
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(SupplierWallet::class);
    }
}