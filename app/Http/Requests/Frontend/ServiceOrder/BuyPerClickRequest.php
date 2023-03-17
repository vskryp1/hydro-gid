<?php

namespace App\Http\Requests\Frontend\ServiceOrder;

use App\Helpers\ShopHelper;
use Illuminate\Foundation\Http\FormRequest;

class BuyPerClickRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone'    => ['required', 'regex:/[' . config('app.phone_chars') . ']*/'],
            'name' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'phone'    => __('frontend/service/index.phone'),
            'name' => __('frontend/service/index.username'),
        ];
    }

}
