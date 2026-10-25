<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'shop_id',
        'subtotal',
        'shipping',
        'tax',
        'discount',
        'total',
        'payment_status',
        'status',
        'payment_method',
        'notes',
        'paid_at',
        'checkout_token', 'checkout_key', 'stripe_checkout_session_id', 'stripe_payment_intent_id',
        'checkout_state', 'checkout_expires_at', 'inventory_reserved', 'shipping_address', 'checkout_payload', 'checkout_currency',
        'shipped_at',
        'delivered_at',
    ];

    protected $hidden = ['shipping_address', 'checkout_payload', 'checkout_token', 'checkout_key'];

    protected $casts = [
        'subtotal' => 'decimal:2', 'shipping' => 'decimal:2', 'tax' => 'decimal:2', 'discount' => 'decimal:2', 'total' => 'decimal:2',
        'shipping_address' => 'encrypted:array',
        'checkout_payload' => 'encrypted:array',
        'checkout_expires_at' => 'datetime',
        'inventory_reserved' => 'boolean',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function rasloShipment()
    {
        return $this->hasOne(RasloShipment::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function supplierPayouts()
    {
        return $this->hasMany(SupplierPayout::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }
}
