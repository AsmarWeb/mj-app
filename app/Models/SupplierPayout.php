<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPayout extends Model
{
    protected $fillable = [
        'supplier_id',
        'order_id',
        'order_item_id',
        'digital_product_id',
        'amount',
        'commission',
        'supplier_amount',
        'status',
        'reference',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function product()
    {
        return $this->belongsTo(DigitalProduct::class, 'digital_product_id');
    }
}
