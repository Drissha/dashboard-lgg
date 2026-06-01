<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page_name'=>'required',
            'slug'=>'required|unique:content_pages',
            'title'=>'required',
            'subtitle'=>'nullable',
            'description'=>'nullable',
            'featured_image'=>'nullable|image',
            'content'=>'nullable',
            'status'=>'required|boolean',
        ];
    }
}