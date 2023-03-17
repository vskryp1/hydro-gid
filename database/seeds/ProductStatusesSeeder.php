<?php

    use App\Models\Product\ProductStatus;
    use Illuminate\Database\Seeder;

    /**
     * Class ProductStatusesSeeder
     */
    class ProductStatusesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            collect([
                [
                    'position' => 1,
                    'default'  => false,
                    'class'    => 'product-label--top',
                    'ru'       => ['name' => 'Топ'],
                ],
                [
                    'position' => 2,
                    'default'  => true,
                    'class'    => 'product-label--pink',
                    'ru'       => ['name' => 'Новый'],
                ],
                [
                    'position' => 3,
                    'default'  => false,
                    'class'    => 'product-label--purple',
                    'ru'       => ['name' => 'Акция'],
                ],
                [
                    'position' => 4,
                    'default'  => false,
                    'class'    => 'product-label--primary',
                    'ru'       => ['name' => 'Распродажа'],
                ],
                [
                    'position' => 5,
                    'default'  => false,
                    'class'    => 'product-label--acua',
                    'ru'       => ['name' => 'Хит'],
                ],
            ])->each(function(array $productStatus) {
                ProductStatus::create($productStatus);
            });
        }
    }
