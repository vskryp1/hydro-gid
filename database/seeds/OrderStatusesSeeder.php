<?php

    use App\Models\Order\OrderStatus;
    use Illuminate\Database\Seeder;

    /**
     * Class OrderStatusesSeeder
     */
    class OrderStatusesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $product_statuses = [
                [
                    'position' => 1,
                    'default'  => true,
                    'uk'       => ['name' => 'Новий'],
                    'ru'       => ['name' => 'Новый'],
                ],
                [
                    'position' => 2,
                    'uk'       => ['name' => 'Оплачено'],
                    'ru'       => ['name' => 'Оплачен'],
                ],
                [
                    'position' => 3,
                    'uk'       => ['name' => 'В обробці'],
                    'ru'       => ['name' => 'В оброботке'],
                ],
                [
                    'position'  => 4,
                    'processed' => true,
                    'uk'        => ['name' => 'Доставлений'],
                    'ru'        => ['name' => 'Доставлен'],
                ],
                [
                    'position' => 5,
                    'uk'       => ['name' => 'Скасовано'],
                    'ru'       => ['name' => 'Отменен'],
                ],
            ];

            foreach ($product_statuses as $product_status) {
                OrderStatus::create($product_status);
            }
        }
    }
