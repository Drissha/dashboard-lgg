<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateContentPageRequest
extends StoreContentPageRequest
{
    public function rules(): array
    {
        return [
            'page_name'=>'required',

            'slug'=>[
                'required',
                Rule::unique('content_pages')
                    ->ignore(
                        $this->content_page
                    )
            ],

            'title'=>'required',
            'subtitle'=>'nullable',
            'description'=>'nullable',
            'featured_image'=>'nullable|image',
            'content'=>'nullable',
            'status'=>'required|boolean',
        ];
    }
}