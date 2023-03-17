<?php

    namespace App\Http\Requests\Frontend\Profile;

    use Illuminate\Foundation\Http\FormRequest;

    class ChangePasswordRequest extends FormRequest
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
                'oldPassword' => 'required|alpha_dash|min:8|max:20',
                'newPassword' => 'required|alpha_dash|min:8|max:20|confirmed',
            ];
        }
    }