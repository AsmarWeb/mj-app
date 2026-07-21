<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCard extends Model
{
    protected $fillable = [
       'shop_id',
       'title',
       'phone',
       'email',
       'website',
       'background_color',
       'text_color',
       'qr_code'
    ];

    public function shop()
    {
    return $this->belongsTo(Shop::class);
    }
}
