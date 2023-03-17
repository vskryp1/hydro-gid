<?php

    namespace App\Http\Requests\Frontend\Profile;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class UpdateUserFormRequest extends FormRequest
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
                    Rule::unique('clients', 'phone')->ignore($this->user),
                    'regex:/[' . config('app.phone_chars') . ']*/',
                ],
                'email'               => [
                    'required',
                    'email',
                    Rule::unique('clients', 'email')->ignore($this->user),
                ],
                'is_legal_entity'     => ['boolean'],
                'company_name'        => [
                    'nullable',
                    'string',
                    'max:255',
                    //Rule::unique('clients', 'company_name')->ignore($this->user),
                ],
                'edrpou'              => [
                    'nullable',
                    'numeric',
//                    'digits:8',
                    Rule::unique('clients', 'edrpou')->ignore($this->user),
                ],
                'is_active'           => ['boolean'],
                'address.region_id.*' => ['nullable', 'max:255', 'exists:regions,id'],
                'address.city.*'      => ['nullable', 'string', 'max:255'],
                'address.address.*'   => ['nullable', 'string', 'max:255'],
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
