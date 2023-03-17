<?php

namespace App\Rules\Backend;

use Illuminate\Contracts\Validation\Rule;

class EntityIdRule implements Rule
{

    private $model;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !is_null(($this->model)::onlyActive()->find($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Entity ID doesn\'t exists';
    }
}
