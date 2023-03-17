<?php

    namespace App\Http\Requests\Backend\Addresses;

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
                'place_id' => ['required', 'string', 'max:255'],
                'street'   => ['required', 'string', 'max:255'],
                'house'    => ['required', 'string', 'max:255'],
            ];
        }
    }
