<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Shop extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'shops';

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'banner',
        'type',
        'description',
        'location',
        'section_id',
        'country_id',
        'state_id',
        'city_id',
        'rating',
        'published_at',
        'user_id'
    ];

    protected $dates = ['published_at']; 

    protected $casts = [
        'published_at' => 'datetime',
        'rating' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listing(): HasMany
    {
        return $this->hasMany(Listing::class, 'shop_id', 'id');
    }

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>', Carbon::now());
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::now();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function country()
    {
    return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
    return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
    return $this->belongsTo(City::class, 'city_id');
    }

}
