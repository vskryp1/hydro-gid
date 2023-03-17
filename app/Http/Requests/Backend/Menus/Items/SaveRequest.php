<?php

    namespace App\Http\Requests\Backend\Menus\Items;

    use App\Models\Menu\MenuItem;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;
    use Setting;

    /**
     * Class SaveRequest
     *
     * @package App\Http\Requests\Backend\Menus\Items
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
            $rules = [];

            foreach (Setting::get('locales') as $lang => $locale) {
                $rules[$lang . '.name'] = 'nullable|max:255';
            }

            $rules['menu_id']      = 'required|exists:menus,id';
            $rules['menu_item_id'] = 'nullable|exists:menu_items,id';
            $rules['position']     = 'numeric|digits_between:1,11';
            $rules['type']         = ['required', 'integer', Rule::in(array_keys(MenuItem::MENU_ITEM_TYPES))];

            return $rules;
        }
    }
