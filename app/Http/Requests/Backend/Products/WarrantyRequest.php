<?php

namespace App\Http\Requests\Backend\Products;

use App;
use Illuminate\Foundation\Http\FormRequest;
use Setting;

class WarrantyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price'    => 'required|numeric|between:0.1,999999.999999',
            'amount'   => 'required|integer|between:1,65535',
            'position' => 'required|integer|between:1,255',
        ];
    }
}
