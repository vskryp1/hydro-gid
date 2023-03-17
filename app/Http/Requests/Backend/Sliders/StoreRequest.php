<?php

    namespace App\Http\Requests\Backend\Sliders;

    use Astrotomic\Translatable\Validation\RuleFactory;
    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class RegionRequest
     *
     * @package App\Http\Requests\Backend\Deliveries
     */
    class StoreRequest extends FormRequest
    {

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(): array
        {
            $rules = [];

            $rules['active'] = 'boolean';
            $rules['alias']  = 'max:255|unique:sliders,alias,' . $this->slider ?? null . ',deleted_at,NULL';

            $rules                    = RuleFactory::make([
                '%name%'        => 'required|string|max:255',
            ]);

            return $rules;
        }
    }
