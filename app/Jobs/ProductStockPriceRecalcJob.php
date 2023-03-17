<?php

namespace App\Jobs;

use App\Helpers\ShopHelper;
use App\Models\Product\Product;
use App\Services\StockService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProductStockPriceRecalcJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;

    /**
     * ProductStockPriceRecalcJob constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stockService                  = new StockService($this->product->stock->first());
        $this->product->original_price = $stockService->calculateDiscount(
            $this->product->original_price_old,
            $this->product->currency
        );
        $this->product->price          = $stockService->calculateDiscount(
            $this->product->price_old,
            ShopHelper::default_currency()
        );
        $this->product->save();
    }
}