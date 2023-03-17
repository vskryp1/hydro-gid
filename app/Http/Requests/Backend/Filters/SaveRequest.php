<?php

    namespace App\Http\Requests\Backend\Filters;

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
            $rules['alias']          = 'max:255|unique:filters,alias,' . $this->route('filter') . ',id,deleted_at,NULL';
            $rules['filter_type_id'] = 'required|exists:filter_types,id';
            $rules['position']       = 'numeric|digits_between:1,11';
            $rules['categories']     = 'required|array';
            $rules['categories.*']   = 'required|exists:pages,id|no_js_validation';

            return $rules;
        }
    }
