<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Listing extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasSlug;


    protected $dates = ['deleted_at'];
    protected $table = 'listings';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            $model->updated_by = NULL;
        });

        static::updating(function ($model) {
            $model->updated_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
        });

        // We set the deleted_by attribute before deleted event so we doesn't get an error if Customer was deleted by force (without soft delete).
        static::deleting(function ($model) {
            $model->deleted_by = Auth::user()->id;
            $model->save();
        });
    }

    protected $fillable = [
        'shop_id',
        'title',
        'title_ar',
        'sku',
        'slug',
        'price',
        'quantity',
        'description',
        'features',
        'keywords',
        'image',
        'video',
        'images',
        'price_condition',
        'condition',
        'shipping_method',
        'delivery_days', 
        'featured',
        'featured_at'
    ]; 

    protected $casts = [
        'features' => 'array',
        'keywords' => 'array',
        'images' => 'array',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'active' => 'boolean',
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function __construct(array $attributes = [])
    {
        $this->setRawAttributes([
            'sku' => Carbon::now()->format('Y-m-d') . mt_rand(10000000, 99999999),
        ], true);
        parent::__construct($attributes);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'user_id', 'id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function subcategories(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getRatingAttribute()
    {
        return $this->reviews()
        ->where('approved', true)
        ->avg('rating');
    }

    

    /**
     * Scope a query to only include the product with the highest price.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHighestPrice($query)
    {
        return $query->orderBy('price', 'desc')->first();
    }

    /**
     * Scope a query to only include the product with the lowest price.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowestPrice($query)
    {
        return $query->orderBy('price', 'asc')->first();
    }

    /**
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getUrlAttribute()
    {
    return route('listing.show', [
        'shop' => $this->shop->slug,
        'section' => $this->section->slug,
        'category' => $this->category->slug,
        'subcategories' => optional($this->subcategories)->slug ?? 'all',
        'brand' => optional($this->brand)->slug ?? 'general',
        'listing' => $this->slug,
    ]);
    }
}
