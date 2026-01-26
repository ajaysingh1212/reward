<?php

namespace App\Http\Requests;

use App\Models\WebPage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWebPageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('web_page_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
