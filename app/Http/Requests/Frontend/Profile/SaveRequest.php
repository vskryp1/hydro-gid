<?php

    namespace App\Http\Requests\Frontend\Profile;

    use App\Rules\Frontend\OldPasswordRule;
    use Illuminate\Foundation\Http\FormRequest;

    class SaveRequest extends FormRequest
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
                'name'         => 'required|string|max:255',
                'email'        => 'required|string|email|max:255|unique:clients,email,' . auth()->user()->id . ',id,deleted_at,NULL',
                'region_id'    => 'required|exists:regions,id',
                'zip'          => 'required|max:255',
                'city'         => 'required|max:255',
                'address'      => 'required|max:255',
                'phone'        => 'required|max:255',
                'birthday'     => 'nullable|max:255',
                'password'     => 'nullable|confirmed|min:6',
                'old_password' => ['nullable','required_with:password,password_confirmation', 'min:6', new OldPasswordRule()],
            ];
        }
    }
