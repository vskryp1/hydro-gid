<?php

namespace App\Http\Requests\Backend\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function getUserIdentityRules()
    {
        return strpos(request()->get('user_identity'), '@')
            ? 'required|max:30|email|exists:users,email'
            : 'required|max:30|exists:users,phone';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public static function getUserIdentityField()
    {
        return strpos(request()->get('user_identity'), '@')
            ? 'email'
            : 'phone';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_identity'             => $this->getUserIdentityRules(),
            'new_password'              => 'required|min:5|max:20',
            'new_password_confirmation' => 'required|min:5|max:20|in:' . request()->new_password,
        ];
    }
}
