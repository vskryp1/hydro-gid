<?php

    namespace App\Http\Requests\Backend\Filters\Values;

    use Illuminate\Foundation\Http\FormRequest;
    use Setting;

    class SaveRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            $rules = [];

            foreach (Setting::get('locales') as $lang => $locale) {
                $rules[$lang . '.name'] = 'required|max:255';
            }
            $rules['alias']     = 'max:255|unique:filter_values,alias,'
                . $this->route('value') . ',id,deleted_at,NULL,'
                . 'filter_id,' . $this->route('filter');
	        $rules['position']   = 'numeric|digits_between:1,11';
	        $rules['filter_id'] = 'required|exists:filters,id';

            return $rules;
        }
    }
