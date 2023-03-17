<?php

    namespace App\Http\Requests\Frontend\Auth;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Input;

    class CheckEmailRequest extends FormRequest
    {
        protected $redirect = '#modalMoreInfo';


        public function __construct(
            array $query = array (),
            array $request = array (),
            array $attributes = array (),
            array $cookies = array (),
            array $files = array (),
            array $server = array (),
            $content = null
        ) {
            parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
            $this->redirect = url()->previous() . $this->redirect;
        }

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
                'email' => 'nullable|email|max:255|unique:clients,email,NULL,id,deleted_at,NULL',
            ];
        }

        public function all($keys = null)
        {
            $request          = Input::all();
            $request['email'] = isset($request['email']) ? strtolower($request['email']) : '';
            return $request;
        }

    }
