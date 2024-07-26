<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';

    public $orderable = [
        'id', 'name', 'name_ar', 'image'
    ];

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'image'
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

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'section_id', 'id')
            ->where(['parent_id' => 0, 'status' => 'active'])->with('subcategories');
    }

    public function listing(): HasMany
    {
        return $this->hasMany(Listing::class, 'section_id', 'id');
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
