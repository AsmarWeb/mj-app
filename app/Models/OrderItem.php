<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [

        'order_id',
        'digital_product_id',
        'listing_id',
        'listing_name',
        'price',
        'quantity',
        'total',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    } 

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class, 'digital_product_id');
    }
}
