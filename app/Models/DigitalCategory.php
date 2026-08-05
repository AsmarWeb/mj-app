<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalCategory extends Model
{
    protected $fillable = [

        'name',
        'name_ar',
        'slug',
        'image',
        'status',

    ];

    public function digitalProduct()
    {
        return $this->hasMany(DigitalProduct::class);
    }
}
