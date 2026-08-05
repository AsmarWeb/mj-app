<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'downloads';

    protected $fillable = [
        'user_id',
        'digital_product_id',
        'token',
        'paid',
        'paid_at',
    ];

    public function product()
    {
        return $this->belongsTo(DigitalProduct::class, 'digital_product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
