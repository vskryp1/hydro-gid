<?php

    namespace App\Http\Requests\Frontend\Auth;

    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class ForgotPasswordRequest
     *
     * @package App\Http\Requests\Frontend\Auth
     */
    class ForgotPasswordRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize(): bool
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(): array
        {
            return [
                'email' => 'required|email|exists:clients',
            ];
        }
    }
