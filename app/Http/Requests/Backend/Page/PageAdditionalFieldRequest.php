<?php

    namespace App\Http\Requests\Backend\Page;

    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class PageAdditionalFieldRequest
     *
     * @package App\Http\Requests\Backend\Page
     */
    class PageAdditionalFieldRequest extends FormRequest
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
                'name'                          => 'required|string',
                'key'                           => 'required|max:255|unique:page_additional_fields,key',
                'default'                       => 'nullable|string',
                'active'                        => 'boolean',
                'page_template_id'              => 'required|exists:page_templates,id',
                'page_additional_field_type_id' => 'required|exists:page_additional_field_types,id',
            ];
        }
    }
