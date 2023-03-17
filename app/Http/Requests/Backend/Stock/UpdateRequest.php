<?php

    namespace App\Http\Requests\Backend\Stock;

    use Astrotomic\Translatable\Validation\RuleFactory;
    use Illuminate\Foundation\Http\FormRequest;
    use Setting;

    /**
     * Class UpdateRequest
     *
     * @package App\Http\Requests\Backend\Products
     */
    class UpdateRequest extends FormRequest
    {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(): array
        {
            $rules                    = RuleFactory::make([
                '%name%'        => 'required|string|max:255',
                '%description%' => 'nullable|string|max:65535',
            ]);
            $rules['start_date']      = ['required', 'date'];
            $rules['expiration_date'] = ['required', 'date'];
            $rules['position']        = ['required', 'numeric', 'digits_between:1,11'];
            $rules['page_id']         = ['nullable', 'exists:pages,id'];
            $rules['active']          = 'boolean';
            $rules['discount']        = ['required', 'numeric', 'min:0'];
            $rules['is_percentage']   = 'boolean';
            $rules['uploaded_image']  = [
                'nullable',
                'mimes:' . config('app.image_mimes'),
                'max:' . config('app.image_size'),
            ];
            $rules['products']        = 'required|array';
            $rules['products.*']      = 'required|exists:products,id';

            return $rules;
        }
    }
