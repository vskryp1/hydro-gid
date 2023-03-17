<?php

    namespace App\Http\Requests\Frontend\Auth;

    use Illuminate\Foundation\Http\FormRequest;

    class LoginRequest extends FormRequest
    {
        public function authorize(): bool
        {
            return true;
        }

        public function rules(): array
        {
            return [
                'email'    => [
                    'required',
                    'email',
                    'exists:clients,email'
                ],
                'password' => [
                    'required',
                    'min:8',
                ],
            ];
        }
    }
