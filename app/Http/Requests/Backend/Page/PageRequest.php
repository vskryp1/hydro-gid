<?php

    namespace App\Http\Requests\Backend\Page;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;
    use Setting;

    /**
     * Class PageRequest
     *
     * @package App\Http\Requests\Backend\Page
     */
    class PageRequest extends FormRequest
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

            $rules['page_template_id'] = ['required', 'exists:page_templates,id'];
            $rules['alias']            = [
                'nullable',
                'max:255',
                'regex:/[' . config('app.alias_chars') . ']*/',
                Rule::unique('pages', 'alias')->ignore($this->page),
            ];
            $rules['position']         = ['nullable', 'integer'];
            $rules['active']           = ['boolean'];
            $rules['only_auth']        = ['boolean'];
            $rules['use_sitemap']      = ['boolean'];

            return $rules;
        }
    }
