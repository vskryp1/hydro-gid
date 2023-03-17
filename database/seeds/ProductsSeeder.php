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
    class ProductsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::Table('product_translations')->truncate();
            DB::Table('filter_value_product')->truncate();
            DB::Table('product_images')->truncate();
            DB::Table('page_product')->truncate();
            DB::Table('products')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            $categories    = Page::productCategories()->get();
            $uah           = Currency::whereCode('UAH')->first()->id;
            $statuses      = ProductStatus::orderBy('position', 'desc')->get();
            $packing       = Filter::with('filter_values')->whereAlias('packing')->first();
            $filter_values = FilterValue::where('filter_id', '<>', $packing->id)->get();

            $product = Product::create([
                'group_position'     => 0,
                'currency_id'        => $uah,
                'product_status_id'  => $statuses->first()->id,
                'sku'                => 'TOV1',
                'alias'              => '',
                'original_price'     => 200,
                'price'              => 200,
                'price_old'          => 0,
                'original_price_old' => 0,
                'rating'             => 5,
                'position'           => 101,
                'ru'                 => [
                    'name' => 'Аксиально-поршневой насос ВАР 37-110см3 (гидравлика)',

                ],
            ]);
            $product->pages()->sync($categories->pluck('id')->toArray());
            $product->filter_values()->sync(FilterValue::whereIn('alias', ['40cm3'])->pluck('id')->toArray());

            $product = Product::create([
                'group_position'     => 0,
                'currency_id'        => $uah,
                'product_status_id'  => $statuses->first()->id,
                'sku'                => 'TOV2',
                'alias'              => '',
                'original_price'     => 100,
                'price'              => 100,
                'price_old'          => 0,
                'original_price_old' => 0,
                'rating'             => 5,
                'position'           => 102,
                'ru'                 => [
                    'name'        => 'Гидрораспределитель (гидравлика)',
                    'description' => '
                    <div class="h3">Гидрораспределитель WE6 НА</div>
                    <p>
                        Гидрораспределители WE6 НА являются гидроаппаратами плитного (стыкового) монтажа. Их преимущества в удобном, простом монтаже, компактности гидроблока. Они являются полным аналогом
                        агрегатов серий: BE6, PE6. Производителем гидрораспределителей WE6 НА является успешная итальянская компания «OLEODINAMICA MOZIONI», которая по соотношению цена-качество производимой
                        гидравлической продукции является конкурентоспособной на европейском рынке гидрооборудования. Гидрораспределители WE6 НА этой компании производятся по всем европейским стандартам и
                        являются прямыми аналогами гидрораспределителей этого же типоразмера (ДУ6) ведущих мировых производителей, таких как «Rexroth», «Parker», «Vickers», «Atos», «Ponar» итд
                    </p>
                    <div class="h3">Модификации и присоединительные размеры WE6 НА</div>
                    <p>
                        Гидрораспределители WE6 НА в стандартном исполнении для более удобной диагностики его работы комплектуются разъемом со светодиодной индикацией. Стыковая поверхность гидрораспределителя
                        унифицирована, обеспечивая взаимозаменяемость с гидроаппаратами других производителей. Монтаж осуществляется с помощью четырех винтов М5х50 с внутренним шестигранником
                    </p>
                    <img src="assets/frontend/images/img-15.jpg"/>
                    <div class="h3">Модификации и присоединительные размеры WE6 НА</div>
                    <p>
                        Гидрораспределители WE6 НА в стандартном исполнении для более удобной диагностики его работы комплектуются разъемом со светодиодной индикацией. Стыковая поверхность гидрораспределителя
                        унифицирована, обеспечивая взаимозаменяемость с гидроаппаратами других производителей. Монтаж осуществляется с помощью четырех винтов М5х50 с внутренним шестигранником
                    </p>
                    ',
                ],
            ]);
            $product->pages()->sync($categories->pluck('id')->toArray());
            $product->filter_values()->sync(FilterValue::whereIn('alias', ['80cm3', 'japan'])->pluck('id')->toArray());

            $product = Product::create([
                'group_position'     => 0,
                'currency_id'        => $uah,
                'product_status_id'  => $statuses->first()->id,
                'sku'                => 'TOV3',
                'alias'              => '',
                'original_price'     => 1,
                'price'              => 1,
                'price_old'          => 0,
                'original_price_old' => 0,
                'rating'             => 5,
                'position'           => 103,
                'ru'                 => [
                    'name' => 'Регулятор расхода 3-линейный со сбросом (гидравлика)',
                ],
            ]);
            $product->pages()->sync($categories->pluck('id')->toArray());
            $product->filter_values()->sync(FilterValue::whereIn('alias',
                ['110cm3', 'usa', 'japan'])->pluck('id')->toArray());

            factory(Product::class, 10)->create()->each(function($product) use (
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
