<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    protected $fillable = [
        'subcategory_name',
        'subcategory_name_ar',
        'slug',
        'category_id',
        'category_name',
    ];

    // En una subcategory pueden haber muchos products
    public function listing(): HasMany
    {
        return $this->hasMany(Listing::class, 'subcategory_id', 'id');
    }

    // Al recoger solo un dato pongo el nombre de la funcion en singular
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Relacion uno a muchos inversa.
    }
}
