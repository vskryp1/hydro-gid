<?php

namespace App\Http\Requests\Backend\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Setting;

class OrderStatusRequest extends FormRequest
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
        $rules = [];

        foreach (Setting::get('locales') as $lang => $locale) {
            $rules[$lang . '.name'] = 'required|max:255';
        }
        $rules['color']    = 'nullable|string|max:255';
        $rules['position'] = 'required|numeric|digits_between:1,9';
        $rules['active']   = 'boolean';

        return $rules;
    }
}
