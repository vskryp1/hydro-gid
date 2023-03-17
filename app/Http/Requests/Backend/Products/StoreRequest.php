<?php

namespace App\Http\Requests\Backend\Products;

use App;
use Illuminate\Foundation\Http\FormRequest;
use Setting;
use App\Enums\ProductAvailability;
use App\Enums\ProductSaleType;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        foreach (Setting::get('locales') as $lang => $locale) {
            $rules[$lang . '.name'] = 'required|max:255';
        }
        $id = is_object($this->product) ? $this->product->id : $this->product;
        $rules['alias']               = 'max:100|unique:products,alias,' . $id . ',id,deleted_at,NULL';
        $rules['sku']                 = 'max:100|unique:products,sku,' . $id . ',id,deleted_at,NULL';
        $rules['original_price']      = 'required_without:original_price_old|numeric|between:0,999999.999999';
        $rules['original_price_old']  = 'required_without:original_price|numeric|between:0,999999.999999';
        $rules['position']            = 'numeric|digits_between:1,11';
        $rules['currency_id']         = 'required|exists:currencies,id';
        $rules['active']              = 'boolean';
        $rules['availability']        = 'required|enum_value:' . ProductAvailability::class;
        $rules['sale_type']           = 'required|enum_value:' . ProductSaleType::class;
        $rules['categories']          = 'required|array';
        $rules['categories.*']        = 'required|exists:pages,id|no_js_validation';
        $rules['main_category']       = 'required|exists:pages,id';
	    $rules['warranties.amount']   = 'nullable|integer|between:1,65535';
        $rules['warranties.price']    = 'required_with:warranties.amount|nullable|numeric|between:0.1,999999.999999';
        $rules['warranties.position'] = 'required_with:warranties.amount|nullable|integer|between:1,255';
	    $rules['expected_at']         = 'required_if:availability,' . ProductAvailability::EXPECTED_DELIVERY . '|after:today|nullable';
        return $rules;
    }
}
