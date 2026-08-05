<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = [

        'user_id',
        'name',
        'role',
        'github',
        'linkedin',
        'website',
        'bio',
        'avatar',
        'approved',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
