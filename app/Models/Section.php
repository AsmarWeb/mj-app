<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';

    protected $fillable = [
        'code',
        'name',
        'name_ar',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setRawAttributes([
            'code' => Str::random(8),
        ], true);
        parent::__construct($attributes);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'section_id', 'id')
            ->where(['parent_id' => 0, 'status' => 'active'])->with('subcategories');
    }

    public function listing(): HasMany
    {
        return $this->hasMany(Listing::class, 'section_id', 'id');
    }
}
