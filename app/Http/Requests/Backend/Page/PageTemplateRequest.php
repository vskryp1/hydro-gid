<?php

    namespace App\Http\Requests\Backend\Page;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class PageTemplateRequest extends FormRequest
    {
        public function authorize(): bool
        {
            return true;
        }

        public function rules(): array
        {
            return [
                'name'        => [
                    'required',
                    'string',
                    'min:3',
                    'max:255',
                    Rule::unique('page_templates', 'name')->ignore($this->template),
                ],
                'folder'      => [
                    'required',
                    'string',
                    'min:3',
                    'max:255',
                    Rule::unique('page_templates', 'folder')->ignore($this->template),
                ],
                'content'     => [
                    'required',
                    'string',
                ],
                'active'      => 'boolean',
                'is_category' => 'boolean',
            ];
        }

        public function attributes(): array
        {
            return [
                'folder' => __('backend.folder'),
                'content' => __('backend.content'),
            ];
        }
    }
