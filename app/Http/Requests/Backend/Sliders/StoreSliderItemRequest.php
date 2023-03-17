<?php

    namespace App\Http\Requests\Backend\Sliders;

    use App\Helpers\ShopHelper;
    use Astrotomic\Translatable\Validation\RuleFactory;
    use Illuminate\Foundation\Http\FormRequest;
    use Setting;

    /**
     * Class RegionRequest
     *
     * @package App\Http\Requests\Backend\Deliveries
     */
    class StoreSliderItemRequest extends FormRequest
    {

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(): array
        {
            $rules = [];

            $rules['active']    = 'boolean';
            $rules['slider_id'] = 'required|exists:sliders,id';
            $rules['position']  = 'numeric|digits_between:1,99|required';

            $rules = RuleFactory::make([
                '%alt%' => 'nullable|string|max:255',
                '%title%' => 'nullable|string|max:255',
                '%image%' => [
                    'nullable',
                    'mimes:' . ShopHelper::setting('image_mimes', config('app.image_mimes')),
                    'max:' . ShopHelper::setting('image_size', config('app.image_size')),
                ],
                '%link%'        => 'nullable|string|max:255',
                '%name%'        => 'nullable|string|max:255',
                '%description%' => 'nullable|string|max:255',
            ]);

            return $rules;
        }
    }
