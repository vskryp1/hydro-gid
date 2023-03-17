<?php

use App\Models\Stock\Stock;
use Illuminate\Database\Seeder;

/**
 * Class BlogSeeder
 */
class HotFixPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (Stock::onlyActive()->goinOn()->get() as $stock) {
            $stock->products->each(
                function ($product) {
                    $coef                        = 1.3333;
                    $product->price_old          = $product->price_old * $coef;
                    $product->original_price_old = $product->original_price_old * $coef;
                    $product->original_price     = $product->original_price * $coef;
                    $product->price              = $product->price * $coef;
                    $product->save();
                }
            );
        }
    }
}
