<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentPage extends Model
{
    protected $fillable = [
        'page_name',
        'slug',
        'title',
        'subtitle',
        'description',
        'featured_image',
        'content',
        'status',
    ];
}