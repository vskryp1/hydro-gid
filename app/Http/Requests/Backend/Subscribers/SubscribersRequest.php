<?php

namespace App\Http\Requests\Backend\Subscribers;

use Illuminate\Foundation\Http\FormRequest;

class SubscribersRequest extends FormRequest
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
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        $data = $this->all();
        if (isset($data['mail_count'])) {
            $data['mail_count'] = (int)str_replace(',', '.', $this->mail_count);
        }

        if (isset($data['timeout'])) {
            $data['timeout'] = str_replace(',', '.', $this->timeout);
        }

        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mail_count' => 'required|integer|max:10000',
            'timeout' => 'required|numeric|max:10000',
        ];
    }
}
