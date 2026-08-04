<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable=[
    'shop_id',

    'order_id',

    'invoice_number',

    'customer_name',

    'customer_email',

    'customer_phone',

    'subtotal',

    'tax',

    'total',

    'status'
];


public function shop()
{
    return $this->belongsTo(Shop::class);
}



public function order()
{
    return $this->belongsTo(Order::class);
}



public function items()
{
    return $this->hasMany(InvoiceItem::class);
}

// Customer from order
    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            Order::class,
            'id',        // orders.id
            'id',        // users.id
            'order_id',  // invoices.order_id
            'user_id'    // orders.user_id
        );
    }
}
