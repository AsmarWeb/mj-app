<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = ['title', 'title_ar', 'description', 'description_ar', 'bg_color'];

    public function color()
    {
        return ['red', 'green', 'yellow', 'blue', 'purple'][$this->id % 5];
    }
}
