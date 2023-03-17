<?php

namespace App\Http\Requests\Frontend\ServiceOrder;

use App\Helpers\ShopHelper;
use Illuminate\Foundation\Http\FormRequest;

class SaveFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone'    => ['required', 'regex:/[' . config('app.phone_chars') . ']*/'],
            'username' => ['required_unless:type,2', 'string', 'max:255'],
            'email'    => ['required_unless:type,2', 'email'],
            'comment'  => ['nullable', 'string', 'max:65535'],
            'call_me'  => ['nullable', 'boolean'],
            'file'     => [
                'nullable',
                'mimes:' . ShopHelper::setting('file_mimes', config('app.file_mimes')),
                'max:' . ShopHelper::setting('file_size', config('app.file_size')),
            ],
            'page_id'  => ['nullable', 'exists:pages,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'phone'    => __('frontend/service/index.phone'),
            'username' => __('frontend/service/index.username'),
            'email'    => __('frontend/service/index.email'),
            'comment'  => __('frontend/service/index.comment'),
            'call_me'  => __('frontend/content/index.call_me'),
        ];
    }

}
