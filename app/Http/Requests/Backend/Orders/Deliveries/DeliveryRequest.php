<?php

    namespace App\Http\Requests\Backend\Orders\Deliveries;

    use App\Enums\DeliveryType;
    use Illuminate\Foundation\Http\FormRequest;
    use Setting;

    /**
     * Class DeliveryRequest
     *
     * @package App\Http\Requests\Backend\Deliveries
     */
    class DeliveryRequest extends FormRequest
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
            $rules['type']           = ['required','integer', 'enum_value:' . DeliveryType::class];
            $rules['api_key']        = 'nullable|string|max:255';
            $rules['currency_id']    = 'required|exists:currencies,id';
            $rules['original_price'] = 'numeric|between:0,999999.99';
            $rules['position']       = 'required|numeric|digits_between:1,11';
            foreach (Setting::get('locales') as $lang => $locale) {
                $rules[$lang . '.name']        = 'required|string|max:255';
                $rules[$lang . '.description'] = 'nullable|string|max:255';
            }

            return $rules;
        }
    }
