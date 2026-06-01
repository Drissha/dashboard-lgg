<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>'required|string',
            'image'=>'nullable|string',
            'status'=>'boolean',
            'sort_order'=>'integer',
        ];
    }
}
