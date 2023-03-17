<?php

    use App\Models\Currency\Currency;
    use App\Models\Filters\Filter;
    use App\Models\Filters\FilterValue;
    use App\Models\Page\Page;
    use App\Models\Product\Product;
    use App\Models\Product\ProductStatus;
    use Illuminate\Database\Seeder;
    use App\Models\Stock\Stock;

    /**
     * Class ProductsSeeder
     */
    class ProductsAddSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $categories    = Page::productCategories()->get();
            $packing       = Filter::with('filter_values')->whereAlias('packing')->first();
            $filter_values = FilterValue::where('filter_id', '<>', $packing->id)->get();

            factory(Product::class, 1000)->create()->each(function($product) use (
                $categories,
                $filter_values,
                $packing
            ) {
                $current_category = [$categories->random()->id];
                $product->pages()->sync($current_category);
                $fv = [];
                foreach ($filter_values as $filter_value) {
                    if (rand(0, 1)) {
                        $fv[] = $filter_value->id;
                    }
                }
                foreach ($packing->filter_values as $filter_value) {
                    if ($packing->filter_values->last() != $filter_value) {
                        factory(Product::class, 1)->create(['parent_id' => $product->id])->each(function($product) use (
                            $current_category,
                            $fv,
                            $filter_value
                        ) {
                            $fv[] = $filter_value->id;
                            $product->pages()->sync($current_category);
                            $product->filter_values()->sync($fv);
                        });
                    } else {
                        $fv[] = $filter_value->id;
                    }
                }
                $product->filter_values()->sync($fv);
            });

        }
    }
