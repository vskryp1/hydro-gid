<?php

namespace App\Jobs;

use App\Models\Stock\Stock;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;

class RevertStockPricesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $stock;
    protected $products;

    /**
     * ConvertPriceJob constructor.
     *
     * @param      $default_currency
     * @param      $models
     * @param      $fields
     * @param      $currency
     */
    public function __construct(Stock $stock, Collection $products)
    {
        $this->stock = $stock;
        $this->products = $products;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->products->each(
            function ($product) {
                $product->original_price = $product->original_price_old;
                $product->price          = $product->price_old;
                $product->save();
            }
        );
    }
}