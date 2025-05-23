<?php

namespace App\Http\Requests\Backend\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'       => 'required|max:255',
            'email'      => 'required|email|unique:users,email' . ((auth()->user()) ? ',' . auth()->user()->id . ',id' : ''),
            'phone'      => 'string|max:20',
            'password'   => 'nullable|min:6|max:20',
        ];
    }
}
