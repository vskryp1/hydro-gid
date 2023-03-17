<?php

namespace App\Http\Requests\Backend\Products;

use App\Helpers\ShopHelper;
use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'file' => 'required|mimes:' . ShopHelper::setting('image_mimes', config('app.image_mimes')) . '|max:' . ShopHelper::setting('image_size', config('app.image_size'))
        ];
    }
}
