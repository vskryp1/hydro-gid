<?php

    namespace App\Http\Requests\Backend\Review;

    use Illuminate\Foundation\Http\FormRequest;

    class SaveFormRequest extends FormRequest
    {
        public function authorize(): bool
        {
            return true;
        }

        public function rules(): array
        {
            return [
                'reviewable_id'   => ['required'],
                'reviewable_type' => ['required'],
                'rating'          => ['nullable', 'numeric', 'digits_between:1,5'],
                'username'        => ['required', 'string', 'max:255'],
                'email'           => ['required', 'email'],
                'comment'         => ['nullable', 'string'],
                'answer'          => ['nullable', 'string'],
            ];
        }

        public function attributes(): array
        {
            return [
                'reviewable_id'   => __('backend/review/index.object'),
                'reviewable_type' => __('backend/review/index.type'),
                'rating'          => __('backend/review/index.rating'),
                'username'        => __('backend/review/index.username'),
                'email'           => __('backend/review/index.email'),
                'comment'         => __('backend/review/index.comment'),
                'answer'          => __('backend/review/index.answer'),
            ];
        }
    }
