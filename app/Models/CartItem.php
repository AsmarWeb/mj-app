<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'shop_id',
        'listing_id',
        'price',
        'quantity',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
