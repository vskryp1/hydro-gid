<?php

    namespace App\Http\Requests\Backend\Products;

    use Illuminate\Foundation\Http\FormRequest;

    class PromocodeRequest extends FormRequest
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
         * Get data to be validated from the request.
         *
         * @return array
         */
        protected function validationData()
        {
            $data = $this->all();
            if (isset($data['original_discount_size'])) {
                $data['original_discount_size'] = str_replace(',', '.', $this->original_discount_size);
            }

            return $data;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {

            $alias = $this->get('id') != '' ? 'unique:promocodes,alias,' . $this->get('id') . ',id' : 'unique:promocodes,alias';
            return [
                'alias'                  => 'required|max:250|' . $alias,
                'original_discount_size' => 'required|numeric|min:1' . (($this->type == 'percent') ? '|max:100' : '') ,
                'currency_id'            => 'required|exists:currencies,id',
                'expiration_date'        => 'required',
                'use_count'              => ($this->get('type_of_use')) ? '' : 'required|integer|min:1',
            ];
        }
    }
