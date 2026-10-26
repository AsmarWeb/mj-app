<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RasloShipment extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['payload', 'idempotency_key', 'lease', 'tracking_url'];

    protected $casts = ['payload' => 'encrypted:array', 'tracking_url' => 'encrypted', 'requires_price_approval' => 'boolean',
        'next_attempt_at' => 'datetime', 'queued_at' => 'datetime', 'processing_at' => 'datetime', 'last_polled_at' => 'datetime', 'attempts' => 'integer', 'sequence' => 'integer'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function connection()
    {
        return $this->belongsTo(RasloConnection::class, 'raslo_connection_id');
    }
}
