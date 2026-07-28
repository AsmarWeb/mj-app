<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
    'description',
    'description_ar',
    'short_des',
    'short_des_ar',
    'logo',
    'favicon',
    'email',
    'phone',
    'phone2',
    'address',
    'map',
    'facebook',
    'telegram',
    'instagram',
    'tiktok',
    'copyright',
    'copyright_ar',
    ];
}
