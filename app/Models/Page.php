<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    static public function getSlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }
}
