<?php

    namespace App\Http\Requests\Frontend\Checkout;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreStep1Request extends FormRequest
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
                ],
                'phone'           => [
                    'required',
                    'regex:/[' . config('app.phone_chars') . ']*/',
                ],
                'is_legal_entity' => ['boolean', 'in:0,1'],
                'company_name'    => ['sometimes', 'required', 'string', 'max:255'],
                'edrpou'          => ['sometimes', 'required', 'numeric', 'unique:clients,edrpou'],
            ];

            return $rules;
        }
    }