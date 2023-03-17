<?php

	namespace App\Http\Requests\Backend\Filters;

	use Illuminate\Foundation\Http\FormRequest;

	class ByCategoryRequest extends FormRequest
	{
		/**
		 * Determine if the user is authorized to make this request.
		 *
		 * @return bool
		 */
		public function authorize ()
		{
			return true;
		}

		/**
		 * Get the validation rules that apply to the request.
		 *
		 * @return array
		 */
		public function rules ()
		{
			return [
				'categories'   => 'required|array',
				'categories.*' => 'required|exists:pages,id',
				'product'      => 'nullable|exists:products,id',
			];
		}
	}
