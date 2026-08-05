<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DigitalProduct extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        'title_ar',

        'description',
        'description_ar',

        'slug',

        'price',
        'is_free',

        'image',
        'file',

        'version',
        'compatible_with',
        'file_size',
        'included_files',

        'license',

        'preview_url',
        'video_url',

        'requirements',
        'installation',
        'changelog',

        'gallery',

        'downloads',
        'favorites',

        'rating',
        'reviews',

        'featured',

        'digital_category_id',

        'user_id',

        'status',

    ];

    protected $casts = [
        'gallery' => 'array',

        'featured' => 'boolean',

        'is_free' => 'boolean',

        'price' => 'decimal:2',

    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {

            if (empty($product->slug)) {

                $slug = Str::slug($product->title);

                $count = static::where('slug', 'LIKE', "{$slug}%")->count();

                $product->slug = $count
                    ? "{$slug}-".($count + 1)
                    : $slug;
            }

            $product->downloads ??= 0;

            $product->status ??= 'published';

            $product->featured ??= false;

            $product->is_free ??= false;
        });
    }

    public function digitalCategory()
    {
        return $this->belongsTo(DigitalCategory::class);
    }

    public function seller()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function scopeDigital($query)
    {
        return $query
            ->where('is_digital', true)
            ->where('shop_id', 1);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/digital-products'.$this->image);
    }

    public function getFileUrlAttribute()
    {
        return asset('storage/digital-products/'.$this->file);
    }

    public function getFormattedPriceAttribute()
    {
        if ($this->is_free) {
            return 'Free';
        }

        return '$'.number_format($this->price, 2);
    }
}
