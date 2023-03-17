<?php

namespace App\Jobs;

use App\Helpers\ShopHelper;
use App\Models\Stock\Stock;
use App\Services\StockService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CalculateStockPriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $stock;

    /**
     * ConvertPriceJob constructor.
     *
     * @param      $default_currency
     * @param      $models
     * @param      $fields
     * @param      $currency
     */
    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stockService                  = new StockService($this->stock);
        $this->stock->products->each(
            function ($product) use ($stockService) {
                $product->original_price     = $stockService->calculateDiscount(
                    $product->original_price_old,
                    $product->currency
                );
                $product->price              = $stockService->calculateDiscount(
                    $product->price_old,
                    ShopHelper::default_currency()
                );
                $product->save();
            }
        );
    }
}