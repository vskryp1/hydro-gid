<?php

    namespace App\Http\Requests\Frontend\Auth;

    use Illuminate\Foundation\Http\FormRequest;

    class RegisterRequest extends FormRequest
    {
        public function authorize(): bool
        {
            return true;
        }

        public function rules(): array
        {
            $rules = [
                'first_name'      => ['required', 'string', 'max:255'],
                'last_name'       => ['required', 'string', 'max:255'],
                'email'           => [
                    'required',
                    'email',
                    'unique:clients,email',
                ],
                'phone'           => [
                    'required',
                    'regex:/[' . config('app.phone_chars') . ']*/',
                    'unique:clients,phone',
                ],
                'password'        => ['required', 'min:8', 'confirmed'],
                'is_legal_entity' => ['boolean', 'in:0,1'],
                'company_name'    => ['sometimes', 'required', 'string', 'max:255'],
                'edrpou'          => ['sometimes', 'required', 'numeric', 'unique:clients,edrpou'],
            ];

            return $rules;
        }
    }