<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCard extends Model
{
    protected $fillable = [
        'name',
        'company',
        'job_title',
        'phone',
        'email',
        'website',
        'address',
        'color'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
