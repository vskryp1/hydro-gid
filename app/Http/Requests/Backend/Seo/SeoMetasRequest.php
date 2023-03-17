<?php

    namespace App\Http\Requests\Backend\Seo;

    use Illuminate\Foundation\Http\FormRequest;

    class SeoMetasRequest extends FormRequest
    {
        public $unique;

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
            $this->unique = request()->seo_meta ? "," . request()->seo_meta . ",id" : '';
            return [
                'seo_url'         => 'string|required|max:255|unique:seo_metas,seo_url' . $this->unique,
                'seo_desc'        => 'nullable|max:255',
                'seo_title'       => 'nullable|max:255',
                'seo_keywords'    => 'nullable|max:255',
                'seo_robots'      => 'nullable|max:255',
                'seo_description' => 'nullable|max:255',
                'seo_canonical'   => 'nullable|max:255',
                'seo_content'     => 'nullable|max:65535',
            ];
        }
    }
