<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public $orderable = [
        'id', 'code', 'category_name',
    ];

    protected $fillable = [
        'code',
        'category_name',
        'category_name_ar',
        'slug',
        'section_name',
        'image',
        'parent_id',
        'section_id',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setRawAttributes([
            'code' => Str::random(8),
        ], true);
        parent::__construct($attributes);
    }

    public function sub_categories(): HasMany
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
}
