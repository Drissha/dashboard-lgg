<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'name',
        'active',
        'datetime',
        'images',
    ];

    protected $casts = [
        'active' => 'boolean',
        'datetime' => 'datetime',
        'images' => 'array',
    ];
}
