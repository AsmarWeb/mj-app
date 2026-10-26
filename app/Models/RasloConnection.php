<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RasloConnection extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['api_key', 'webhook_secret'];

    protected $casts = ['enabled' => 'boolean', 'api_key' => 'encrypted', 'webhook_secret' => 'encrypted', 'verified_at' => 'datetime'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
