<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    public function subscription(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
