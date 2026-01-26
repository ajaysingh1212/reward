<?php

namespace App\Http\Requests;

use App\Models\Winner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWinnerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('winner_edit');
    }

    public function rules()
    {
        return [
            'cupon_numbers.*' => [
                'integer',
            ],
            'cupon_numbers' => [
                'required',
                'array',
            ],
            'full_name' => [
                'string',
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
            'upi' => [
                'string',
                'required',
            ],
            'product_name' => [
                'string',
                'nullable',
            ],
            'product_photo' => [
                'array',
            ],
        ];
    }
}
