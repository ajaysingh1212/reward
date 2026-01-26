<?php

namespace App\Http\Requests;

use App\Models\WebPage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWebPageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('web_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:web_pages,id',
        ];
    }
}
