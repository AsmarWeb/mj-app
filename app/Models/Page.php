<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pages';

    

    protected $fillable = [
        'name',
        'slug',
        'title',
        'title_ar',
        'subtitle',
        'subtitle_ar',
        'short_des',
        'short_des_ar',
        'content',
        'content_ar',
        'template',
        'status',
        'published_at',
        'sort_order',
        'image',
        'image_alt',
        'url',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_by',
        'developer',
    ];

    static public function getSlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }
}
