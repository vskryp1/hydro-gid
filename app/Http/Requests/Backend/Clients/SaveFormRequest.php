<?php

    namespace App\Http\Requests\Backend\Clients;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class SaveFormRequest extends FormRequest
    {
        public function authorize(): bool
        {
            return true;
        }

        public function rules(): array
        {
            return [
                'first_name'          => ['required', 'string', 'max:255'],
                'last_name'           => ['required', 'string', 'max:255'],
                'phone'               => [
                    'required',
                    Rule::unique('clients', 'phone')->ignore($this->route('client')),
                    'regex:/[' . config('app.phone_chars') . ']*/',
                ],
                'email'               => [
                    'required',
                    'email',
                    Rule::unique('clients', 'email')->ignore($this->route('client')),
                ],
                'password'            => [
                    'nullable',
                    'min:8',
                ],
                'is_legal_entity'     => ['boolean'],
                'company_name'        => [
                    'nullable',
                    'string',
                    'max:255',
                    //Rule::unique('clients', 'company_name')->ignore($this->route('client')),
                ],
                'edrpou'              => [
                    'nullable',
                    'numeric',
//                    'digits:8',
                    Rule::unique('clients', 'edrpou')->ignore($this->route('client')),
                ],
                'is_active'           => ['boolean'],
                'discount'            => ['required', 'numeric', 'min:0'],
                'is_percentage'       => ['boolean'],
                'address.region_id.*' => ['nullable', 'exists:regions,id'],
                'address.city.*'      => ['required', 'string', 'max:255'],
                'address.street.*'    => ['required', 'string', 'max:255'],
                'address.house.*'     => ['required', 'string', 'max:255'],
            ];
        }

        protected function validationData(): array
        {
            $attributes = $this->all();

            if ($attributes['phone']) {
                $attributes['phone'] = preg_replace('![^\d]+!u', '', $attributes['phone']);
            }

            return $attributes;
        }
    }
