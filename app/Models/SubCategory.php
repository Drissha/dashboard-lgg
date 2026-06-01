<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'description'];

    /**
     * Get the category that owns this sub-category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all products in this sub-category
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id');
    }
}
