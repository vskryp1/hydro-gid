<?php

namespace App\Http\Requests\Backend\Seo;

use Illuminate\Foundation\Http\FormRequest;

class SeoRedirectsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'status_code' => 'integer|required',
            'from'        => 'string|max:255|required',
            'to'          => 'string|max:255|required',
        ];
    }
}
