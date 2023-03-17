<?php

    namespace App\Http\Requests\Backend\Orders\Deliveries;

    use Illuminate\Foundation\Http\FormRequest;
    use Setting;

    /**
     * Class DeliveryRequest
     *
     * @package App\Http\Requests\Backend\Deliveries
     */
    class DeliveryPlaceRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize(): bool
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(): array
        {
            $rules = [];

            $rules['is_active']      = 'boolean';
            $rules['is_default']     = 'boolean';
            $rules['position']       = 'required|numeric|digits_between:1,9';
            $rules['original_price'] = 'numeric|between:0.1,999999.999999';
            foreach (Setting::get('locales') as $lang => $locale) {
                $rules[$lang . '.name']        = 'required|string|max:255';
                $rules[$lang . '.description'] = 'nullable|string';
            }

            return $rules;
        }
    }
