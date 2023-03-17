<?php

    namespace App\Http\Requests\Frontend;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Input;

    class FeedbackRequest extends FormRequest
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
            return [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email',
                'comment' => 'required',
            ];
        }
    }
