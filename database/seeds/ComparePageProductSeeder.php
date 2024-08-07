<?php

use App\Models\Page\Page;
use App\Models\Product\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComparePageProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_product_old')
            ->orderBy('product_id')
            ->chunk(100, function ($items) {
                foreach ($items as $item) {
                    $test = DB::table('page_product')
                        ->where('product_id', '=', $item->product_id)
                        ->where('page_id', '=', $item->page_id)
                        ->first();

                    if (!$test) {
                        $page = Page::query()->where('id', '=', $item->page_id)->first();
                        $product = Product::query()->where('id', '=', $item->product_id)->first();

                        if ($page && $product) {
                            DB::table('page_product')->insert([
                                'product_id' => $item->product_id,
                                'page_id' => $item->page_id,
                                'order_sort' => $item->order_sort,
                                'is_main' => $item->is_main,
                            ]);

                            echo '-';
                        }
                    };
                }
            });
    }
}
