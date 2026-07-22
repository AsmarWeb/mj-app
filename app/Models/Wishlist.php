<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable=[
    'user_id',
    'listing_id'
    ];
    
    public function listing()
    {
    return $this->belongsTo(Listing::class);
    }
}
