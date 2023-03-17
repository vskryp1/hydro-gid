<?php

use App\Events\ChangeCurrencyCourseEvent;
use App\Jobs\CalculateStockPriceJob;
use App\Models\Product\Product;
use App\Models\Stock\Stock;
use Illuminate\Database\Migrations\Migration;

class CalculateProductPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Product::onlyActive()->each(
            function ($item) {
                $item->update(
                    [
                        'original_price_old' => $item->original_price,
                        'price_old'          => $item->price
                    ]
                );
            }
        );
        event(new ChangeCurrencyCourseEvent());

        foreach (Stock::onlyActive()->goinOn()->get() as $stock){
            dispatch(new CalculateStockPriceJob($stock));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
