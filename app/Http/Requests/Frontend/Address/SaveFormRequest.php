<?php

    namespace App\Http\Requests\Frontend\Address;

    use Illuminate\Foundation\Http\FormRequest;

    class SaveFormRequest extends FormRequest
    {

        public function rules(): array
        {
            return [
                'region_id' => ['nullable', 'exists:regions,id'],
                'place_id'  => ['required', 'max:255'],
                'street'    => ['required', 'string', 'max:255'],
                'house'     => ['required', 'string', 'max:255'],
            ];
        }

        public function attributes(): array
        {
            return [
                'region_id' => __('frontend/profile/index.region'),
                'city'      => __('frontend/profile/index.city'),
                'street'    => __('frontend/profile/index.street'),
                'house'     => __('frontend/profile/index.house'),
            ];
        }
    }
