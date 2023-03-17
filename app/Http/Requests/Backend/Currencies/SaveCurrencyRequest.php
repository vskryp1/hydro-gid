<?php

namespace App\Http\Requests\Backend\Currencies;

use Illuminate\Foundation\Http\FormRequest;

class SaveCurrencyRequest extends FormRequest
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
            'code' => 'required|unique:currencies,code,'.$this->route('currency').',id,deleted_at,NULL|max:3',
            'course' => 'required|numeric|between:0.001,999999.999999',
        ];
    }
}
