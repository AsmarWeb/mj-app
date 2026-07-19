<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount',
        'type',
        'expires_at',
        'max_uses',
        'used_count',
        'is_active',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('payment_id', 'discount_amount')
            ->withTimestamps();
    }
}
