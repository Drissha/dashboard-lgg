<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'status' => 'required|boolean',
        ];
    }
}
