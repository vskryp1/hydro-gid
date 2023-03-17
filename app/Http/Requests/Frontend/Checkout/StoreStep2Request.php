<?php

namespace App\Http\Requests\Frontend\Checkout;

use App\Enums\DeliveryType;
use App\Enums\PaymentType;
use Illuminate\Foundation\Http\FormRequest;

class StoreStep2Request extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'warehouse_id'  => 'required_if:delivery_type,' . DeliveryType::PICKUP_NP . '|nullable|string|max:255',
            'delivery_type' => 'required|enum_value:' . DeliveryType::class,
            'delivery_id'   => 'required|exists:deliveries,id',
            'payment_id'    => 'required|exists:payments,id',
            'payparts_month' => 'required_if:payment_type,' . PaymentType::PRIVAT24_BY_PART
        ];

		if(!request()->address_id){
			$rules += [
				'place_api_id' => 'sometimes|required_if:delivery_type,' . DeliveryType::COURIER_NP . ',' . DeliveryType::PICKUP_NP . '|nullable|string|max:255',
				'street' => 'sometimes|required_if:delivery_type,' . DeliveryType::COURIER_NP . '|nullable|string|max:255',
				'house'  => 'sometimes|required_if:delivery_type,' . DeliveryType::COURIER_NP . '|nullable|string|max:255',
			];
		}

	    return $rules;
    }

    protected function getValidatorInstance()
    {
        $validator  = parent::getValidatorInstance();
        $placeTypes = collect([DeliveryType::PICKUP_NP, DeliveryType::COURIER_NP]);

        $validator->sometimes(
            ['address_id'],
            'exists:addresses,id',
            function ($input) use ($placeTypes) {
                return $input->delivery_type == DeliveryType::COURIER_NP
                    && $input->address_id;
            });

        return $validator;
    }
}
