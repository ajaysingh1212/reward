<?php

namespace App\Http\Requests;

use App\Models\RowData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRowDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('row_data_create');
    }

    public function rules()
    {
        return [
            'unique_code' => [
                'string',
                'required',
                'unique:row_datas',
            ],
            'amount' => [
                'string',
                'required',
            ],
            'expiry_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'used_by' => [
                'string',
                'nullable',
            ],
            'used_by_phone' => [
                'string',
                'nullable',
            ],
        ];
    }
}
