<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    protected $fillable = [

        'post_id',

        'file_path',

        'file_type'

    ];



    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
