<?php

    namespace App\Http\Requests\Backend\Faq;

    use Astrotomic\Translatable\Validation\RuleFactory;
    use Illuminate\Foundation\Http\FormRequest;

    class FaqRequest extends FormRequest
    {

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            $rules             = RuleFactory::make([
                '%question%' => 'required|max:64000',
                '%answer%'   => 'required|max:64000',
            ]);
            $rules['active']   = 'required|boolean';
            $rules['position'] = 'required|integer';

            return $rules;
        }
    }
