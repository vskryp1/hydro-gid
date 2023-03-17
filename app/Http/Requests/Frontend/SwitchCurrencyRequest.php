<?php

    namespace App\Http\Requests\Frontend;

    use Illuminate\Foundation\Http\FormRequest;

    class SwitchCurrencyRequest extends FormRequest
    {
        public function authorize(): bool
        {
            return true;
        }

        public function rules(): array
        {
            return [
                'currency' => 'required|exists:currencies,id',
            ];
        }

        public function validationData(): array
        {
            $request = $this->all();

            $request['currency'] = $this->route('currency');

            return $request;
        }
    }
