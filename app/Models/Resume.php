<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resume extends Model
{
    protected $fillable = [

        'user_id',

        'slug',

        'full_name',
        'job_title',
        'email',
        'phone',
        'website',
        'address',

        'photo',

        'summary',

        'experiences',
        'educations',
        'skills',

        'projects',
        'certificates',
        'languages',
        'awards',
        'volunteer',
        'references',

        'template',
        'accent_color',
        'font',
    ];

    protected $casts = [

        'experiences' => 'array',
        'educations' => 'array',
        'skills' => 'array',

        'projects' => 'array',
        'certificates' => 'array',
        'languages' => 'array',
        'awards' => 'array',
        'volunteer' => 'array',
        'references' => 'array',

    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($resume) {

            $resume->slug = Str::slug($resume->full_name)
                .'-'.uniqid();

        });
    }
}
