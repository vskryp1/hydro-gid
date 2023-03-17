<?php

    namespace App\Http\Requests\Backend\ServiceOrder;

    use Illuminate\Foundation\Http\FormRequest;

    class SaveFormRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'phone'    => ['required', 'regex:/[' . config('app.phone_chars') . ']*/'],
                'username' => ['required', 'string', 'max:255'],
                'email'    => ['required', 'email'],
                'comment'  => ['nullable', 'string', 'max:65535'],
                'active'   => ['boolean'],
                'active'   => ['boolean'],
                'file'     => ['nullable', 'boolean'],
                'page_id'  => ['nullable', 'exists:pages,id'],
            ];
        }

        public function attributes(): array
        {
            return [
                'phone'    => __('backend/service/index.phone'),
                'username' => __('backend/service/index.username'),
                'email'    => __('backend/service/index.email'),
                'comment'  => __('backend/service/index.comment'),
            ];
        }
    }
