<?php

namespace App\Http\Requests\Backend\Seo\Sitemap;

use App\Rules\Backend\EntityIdRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'model_id' => new EntityIdRule($this->request->get('model')),
        ];
    }
}
