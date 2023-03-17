<?php


namespace App\Services;

use App\Helpers\ShopHelper;
use App\Jobs\CalculateStockPriceJob;
use App\Models\Currency\Currency;
use App\Models\Stock\Stock;
use Carbon\Carbon;

class StockService
{
    /**
     * @var Stock
     */
    protected $stock;

    /**
     * StockService constructor.
     * @param $stock
     */
    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    /**
     * @param float $price
     * @param Currency $currency
     * @return float
     */
    public function calculateDiscount(float $price, Currency $currency): float
    {
        return $this->stock->is_percentage
            ? $price * (1 - $this->stock->discount / 100)
            : $price - ShopHelper::price_convert($this->stock->discount, ShopHelper::current_currency(), $currency);
    }

    public function updateRelations($product)
    {
        $this->stock->products()->sync($product);
        if ($this->stockIsGoinOn()) {
            dispatch(new CalculateStockPriceJob($this->stock));
        }
    }

    protected function stockIsGoinOn(): bool
    {
        $now = Carbon::now()->toDateString();

        return $this->stock->active
               && $this->stock->start_date <= $now
               && $now <= $this->stock->expiration_date;
    }
}