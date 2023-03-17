<?php

namespace App\Rules\Backend;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckRoleRule implements Rule
{
	public $roles = [];
	public $username;

	/**
	 * Create a new rule instance.
	 *
	 * CheckRoleRule constructor.
	 * @param bool $roles
	 * @param string $username
	 */
    public function __construct($username = 'email')
    {
        $this->username = $username;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
	    return !is_null(User::where($this->username, $value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('backend.user_not_found');
    }
}
