<?php

    namespace App\Http\Requests\Frontend;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Input;

    class SubscribeRequest extends FormRequest
    {

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'email' => 'required|email|max:255',
            ];
        }
    }
