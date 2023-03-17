<?php

namespace App\Http\Requests\Backend\Template;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends FormRequest
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
        $templateId = isset(request()->template) ? request()->template->id : '';
        $rules      = [];
        foreach (\Setting::get('locales') as $lang => $locale) {
            $rules[$lang . '.name'] = "required|max:255|unique:template_translations,name,$templateId,template_id,locale,$lang";

        }
        return $rules;
    }
}
