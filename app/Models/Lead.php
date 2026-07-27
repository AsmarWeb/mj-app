<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
     protected $fillable = [
        'shop_id',
        'listing_id',
        'user_id',
        'type',
    ];


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }


    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
