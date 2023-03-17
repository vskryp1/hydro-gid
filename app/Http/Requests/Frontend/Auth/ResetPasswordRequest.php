<?php

    namespace App\Http\Requests\Frontend\Auth;

    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class ResetPasswordRequest
     *
     * @package App\Http\Requests\Frontend\Auth
     */
    class ResetPasswordRequest extends FormRequest
    {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(): array
        {
            return [
                'password' => 'required|min:8|confirmed',
            ];
        }
    }
