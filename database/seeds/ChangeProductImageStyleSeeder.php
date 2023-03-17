<?php

use App\Models\Product\ProductTranslation;
use Illuminate\Database\Seeder;

class ChangeProductImageStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductTranslation::whereNotNull('description')->chunk(100, function($products) {
            foreach ($products as $product) {
                if(stripos($product->description, 'img')){
                    $product->description = preg_replace_callback('/style[\=\s]*?".*?"/i',
                        function($matches)
                        {
                            return preg_replace(['/width[\s:a-z0-9]*?;/', '/height[\s:a-z0-9]*?;/'], ['width: 100%;', 'height: 100%;'], $matches[0]);
                        }
                        , $product->description);
                    $product->save();
                }
            }
        });
    }
}
