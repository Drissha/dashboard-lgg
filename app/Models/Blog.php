<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title','slug','content','featured_image','author_id','category_id','tags','published_at','status'];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
