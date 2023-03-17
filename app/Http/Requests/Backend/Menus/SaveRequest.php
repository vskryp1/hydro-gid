<?php

    namespace App\Http\Requests\Backend\Menus;

    use App\Models\Menu\Menu;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    /**
     * Class SaveRequest
     *
     * @package App\Http\Requests\Backend\Menus
     */
    class SaveRequest extends FormRequest
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
                'page_id' => [
                    'nullable',
                    'exists:pages,id',
                ],
                'alias'   => [
                    'required',
                    'max:255',
                    Rule::unique('menus', 'alias')->ignore($this->route('menu')),
                ],
                'type'    => [
                    'required',
                    'integer',
                    Rule::in(array_keys(Menu::MENU_TYPES)),
                ],
            ];
        }
    }
