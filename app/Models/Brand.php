<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'brand_name',
        'brand_name_ar',
        'slug',
        'subcategory_id',
        'subcategory_name',
    ];

    public function listing()
    {
        return $this->hasMany(Listing::class);
    }

    public function subcategories()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
}
