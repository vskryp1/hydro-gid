<?php

namespace App\Http\Requests\Backend\Regions;

use Illuminate\Foundation\Http\FormRequest;
use Setting;

/**
 * Class RegionRequest
 *
 * @package App\Http\Requests\Backend\Deliveries
 */
class RegionRequest extends FormRequest
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
        $rules               = [];
        $rules['is_active']  = 'boolean';
        $rules['is_default'] = 'boolean';
        $rules['position']   = 'required|numeric|digits_between:1,9';
        foreach (Setting::get('locales') as $lang => $locale) {
            $rules[$lang . '.name'] = [
                'required',
                'max:255',
                "unique:region_translations,name,{$this->route()->parameter('region')},region_id,locale,{$lang}",
            ];
        }

        return $rules;
    }
}
