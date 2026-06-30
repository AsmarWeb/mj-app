<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';

    protected $fillable = ['country_id', 'name', 'name_ar', 'image'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function listing(): HasMany
    {
        return $this->hasMany(Listing::class, 'state_id', 'id');
    }

    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class);
    }
}
