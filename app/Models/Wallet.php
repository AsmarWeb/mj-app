<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'shop_id',
        'available_balance',
        'pending_balance',
        'total_earned',
    ];


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
