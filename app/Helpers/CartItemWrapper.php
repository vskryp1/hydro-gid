<?php

namespace App\Helpers;

use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Support\Facades\Auth;

class CartItemWrapper
{

    /**
     * @var CartItem
     */
    protected $item;

    /**
     * CartItemWrapper constructor.
     * @param CartItem $item
     */
    public function __construct(CartItem $item)
    {
        $this->item = $item;
    }

    /**
     * @return string
     */
    public function getWarrantyText(): string
    {
        return $this->item->warranty ? $this->getFormatWarrantyText() : '';
    }

    /**
     * @return string
     */
    protected function getFormatWarrantyText(): string
    {
        $args = [
            mb_strtolower(__('frontend/product/index.warranty')),
            $this->item->warranty->amount,
            $this->getWarrantyMonth()
        ];
        $this->item->warranty->price_formatted <= 0 ?: array_push($args, $this->item->warranty->price_formatted);
        $this->item->warranty->price_formatted <= 0 ?: array_push($args, __('frontend/product/index.uah'));

        return vsprintf($this->getWarrantyFormat($args), $args);
    }

    /**
     * @param $args
     *
     * @return string
     */
    protected function getWarrantyFormat(array  $args): string
    {
        return '(' . trim(str_repeat("%s ", count($args))) . ')';
    }

    /**
     * @return string
     */
    protected function getWarrantyMonth(): string
    {
        return __(trans_choice('frontend/product/index.month', ($this->item->warranty->amount < 20
                ? $this->item->warranty->amount
                : $this->item->warranty->amount % 10))) . ($this->item->warranty->price == 0 ? '' : ':');
    }

    /**
     * @return string
     */
    public function getFormattedSumPriceByPosition(): string
    {
        return ShopHelper::price_format($this->getSumPriceByPosition());
    }

    /**
     * @return string
     */
    public function getSumPriceByPosition($allowApplyDiscount = false): float
    {
        return $this->getUnitPriceWithWarranty($allowApplyDiscount) * $this->item->qty;;
    }

    /**
     * @return string
     */
    public function getUnitPrice($allowApplyDiscount = false): float
    {
        return $this->canApplyPersonalDiscount($allowApplyDiscount)
            ? $this->getPriceWithPersonalDiscount()
            : $this->item->model->converted_price;
    }

    /**
     * @return string
     */
    public function getUnitPriceWithWarranty($allowApplyDiscount = false): float
    {
        return $this->getUnitPrice($allowApplyDiscount) + $this->getWarrantyPrice();;
    }

    /**
     * @return string
     */
    public function getWarrantyPrice(): float
    {
        return $this->warranty->converted_price ?? 0;
    }

    /**
     * @return CartItem
     */
    public function getItem(): CartItem
    {
        return $this->item;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if(property_exists($this->item, $name)){
            return $this->item->{$name};
        } elseif(property_exists($this, $name)) {
            return $this->{$name};
        }
    }

    /**
     * @return float
     */
    public function getPriceWithPersonalDiscount(): float
    {
        $user      = Auth::guard('web')->user();
        $basePrice = $this->item->model->converted_price;

        return $user->is_percentage
            ? $this->getDiscountByPercentage($basePrice, $user->discount)
            : $this->getDiscountByAmount($basePrice, $user->discount);
    }

    /**
     * @param $basePrice
     * @param $discount
     * @return float
     */
    public function getDiscountByAmount($basePrice, $discount): float
    {
        return $basePrice > $discount
            ? $basePrice - $discount
            : $basePrice;
    }

    /**
     * @param $basePrice
     * @param $discount
     * @return float
     */
    public function getDiscountByPercentage($basePrice, $discount): float
    {
        return $basePrice - ($basePrice * ($discount / 100));
    }

    /**
     * @return bool
     */
    public function canApplyPersonalDiscount($allowApplyDiscount = false) : bool
    {
        $user = Auth::guard('web')->user();

        return $allowApplyDiscount && $user && $user->discount && !$this->item->model->inStock();
    }


    /**
     */
    public function getOptionsForOrder(): string
    {
        $data = [];
        if($this->item->warranty){
            $data['warranty'] = [
                'price'  => $this->getWarrantyPrice(),
                'amount' => $this->item->warranty->amount
            ];
        }
        return json_encode($data);
    }

}
