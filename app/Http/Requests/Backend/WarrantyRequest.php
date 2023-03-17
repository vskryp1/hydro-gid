<?php

namespace App\Http\Requests\Backend;

use App;
use Illuminate\Foundation\Http\FormRequest;

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
            'price'    => 'nullable|numeric',
            'page_id'  => 'required',
            'amount'   => 'required|integer|between:1,65535',
            'position' => 'required|integer|between:1,255',
        ];
    }
}
