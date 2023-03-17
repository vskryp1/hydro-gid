<?php

namespace App\Http\Requests\Backend\ImportExport;

use Illuminate\Foundation\Http\FormRequest;

class ImportExportRequest extends FormRequest
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
        $rules = [];
        $rules['importExcel']   = 'mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

        return $rules;
    }
}
