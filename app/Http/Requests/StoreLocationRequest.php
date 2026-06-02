<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => 'required|max:255',

            'address' => 'required',

            'open_shop' => 'nullable|string|max:255',

            'kota' => 'nullable|string|max:255',

            'daerah' => 'nullable|string|max:255',

            'google_maps_url' => 'nullable|url',

            'phone' => 'nullable|max:50',

            'description' => 'nullable',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
