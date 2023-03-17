<?php

namespace App\Http\Requests\Backend\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
	    $rules = [
            'unique_id'                          => 'sometimes|unique:orders,unique_id,' . $this->order . ',id,deleted_at,NULL|max:255',
            'name'                               => 'nullable|string|max:255',
            'email'                              => 'required|unique:clients,email,' . $this->client_id . ',id,deleted_at,NULL|max:255',
            'phone'                              => 'nullable|max:30|unique:clients,phone,' . $this->client_id . ',id,deleted_at,NULL|regex:/[' . config(
                    'app.phone_chars'
                ) . ']*/',
            'city'                               => 'nullable|string|max:255',
            'ttn'                                => 'nullable|string|max:255',
            'address'                            => 'nullable|string|max:255',
            'client_id'                          => 'nullable|exists:clients,id',
            'temp_client_id'                     => 'nullable|exists:temp_client_orders,id',
            'address_id'                         => 'nullable|exists:addresses,id',
            'user_id'                            => 'nullable|exists:users,id',
            'order_status_id'                    => 'required|exists:order_statuses,id',
            'delivery_id'                        => 'required|exists:deliveries,id',
            'payment_id'                         => 'required|exists:payments,id',
            'currency_id'                        => 'required|exists:currencies,id',
            'locale'                             => 'required|string|max:3',
            'products.*.options.warranty.price'  => 'nullable|between:0.0,999999.999999',
            'products.*.options.warranty.amount' => 'nullable|max:999999',
            'delivery_price'                     => 'between:0.00,999999.999999|no_js_validation',
            'products'                           => 'present|array',
            'products.*.price'                   => 'required|between:0.1,999999.999999|no_js_validation',
            'products.*.qty'                     => 'required|digits_between:1,11|min:1|no_js_validation',
        ];

        if(request()->get('is_percentage')){
			$rules['discount'] = 'nullable|integer|between:0.1,100.0';
        }

        return $rules;
    }

    protected function validationData()
    {
        $data = $this->all();
        if (isset($data['phone'])) {
            $data['phone'] = preg_replace('![^\d]+!u', '', $data['phone']);
        }

        return $data;
    }
}
