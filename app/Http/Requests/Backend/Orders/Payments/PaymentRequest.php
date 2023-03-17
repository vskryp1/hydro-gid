<?php

    namespace App\Http\Requests\Backend\Orders\Payments;

    use App\Enums\PaymentType;
    use Illuminate\Foundation\Http\FormRequest;
    use Setting;

    /**
     * Class PaymentRequest
     *
     * @package App\Http\Requests\Backend\Payments
     */
    class PaymentRequest extends FormRequest
    {

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(): array
        {
            $rules = [];

            $rules['is_active']  = 'boolean';
            $rules['is_default'] = 'boolean';
            $rules['regions']    = 'required|array';
            $rules['regions.*']  = 'required|exists:regions,id|no_js_validation';
            $rules['type']       = ['required','integer', 'enum_value:' . PaymentType::class];
            $rules['position']   = 'required|numeric|digits_between:1,11';
            $rules['api_key']    = 'nullable|string|max:255';
            foreach (Setting::get('locales') as $lang => $locale) {
                $rules[$lang . '.name'] = 'required|string|max:255';
            }

            return $rules;
        }
    }
