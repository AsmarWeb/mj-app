<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'category_name_ar',
        'slug',
        'image',
        'cover',
        'bg_color',
        'parent_id',
        'section_id',
    ];

    public static function tree()
    {
        $allCategories = Category::where('parent_id', 0)->where('status', 'active')->get();


        $rootCategories = $allCategories->whereNull('parent_id');

        self::formatTree($rootCategories, $allCategories);

        return $rootCategories;
    }

    public static function formatTree($categories, $allCategories)
    {
        foreach ($categories as $Category) {
            $Category->children = $allCategories->where('parent_id', $Category->id)->values();

            if ($Category->children->isNotEmpty()) {
                self::formatTree($Category->children, $allCategories);
            }
        }
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id'); //Relación uno a muchos
    }

    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class, 'category_id', 'id')->where('status', 'active');
    }

    //Relacion entre categories y products atravez de otra relación en este caso Subcategory
    public function listing(): HasMany
    {
        return $this->hasMany(Listing::class, 'category_id', 'id');
    }

    public function color()
    {
        return ['red', 'green', 'yellow', 'blue', 'purple'][$this->id % 5];
    }

    public function getThumbnailUrl()
    {
        $isUrl = str_contains($this->thumbnail, 'http');

        return ($isUrl) ? $this->thumbnail : url($this->thumbnail);
    }
}
