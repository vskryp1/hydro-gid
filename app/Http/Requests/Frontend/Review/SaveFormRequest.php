<?php

    namespace App\Http\Requests\Frontend\Review;

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
                'rating'          => ['required', 'numeric', 'digits_between:1,5'],
                'username'        => ['required', 'string', 'max:255'],
                'email'           => ['required', 'email'],
                'comment'         => ['nullable', 'string'],
            ];
        }

        public function attributes(): array
        {
            return [
                'reviewable_id'   => __('frontend/review/index.object'),
                'reviewable_type' => __('frontend/review/index.type'),
                'rating'          => __('frontend/review/index.rating'),
                'username'        => __('frontend/review/index.username'),
                'email'           => __('frontend/review/index.email'),
                'comment'         => __('frontend/review/index.comment'),
            ];
        }

        public function messages()
        {
            return [
                'rating.required' => __('frontend/review/index.rating_required'),
                'username.required'  => __('frontend/review/index.username_required'),
                'email.required'  => __('frontend/review/index.email_required'),
            ];
        }
    }
