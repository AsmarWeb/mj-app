<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return ['price' => 'decimal:2', 'is_active' => 'boolean', 'is_free' => 'boolean',
            'custom_domain' => 'boolean', 'mobile_app' => 'boolean'];
    }

    public function subscription(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
