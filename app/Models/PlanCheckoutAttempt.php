<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanCheckoutAttempt extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return ['payload' => 'encrypted:array', 'expires_at' => 'datetime'];
    }
}
