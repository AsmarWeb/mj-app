<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Developer extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'role',
        'bio',
        'avatar',
        'github',
        'linkedin',
        'website',
        'approved',
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
