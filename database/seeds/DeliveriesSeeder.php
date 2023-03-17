<?php

    use App\Jobs\GetCitiesNPJob;
    use App\Models\Currency\Currency;
    use App\Models\Order\Delivery;
    use Illuminate\Database\Seeder;
    use App\Enums\DeliveryType;

    /**
     * Class DeliveriesSeeder
     */
    class DeliveriesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $currencies = Currency::all();
            $deliveries = [
                [
                    'currency_id'    => $currencies->random()->id,
                    'is_active'      => true,
                    'is_default'     => true,
                    'type'           => DeliveryType::PICKUP,
                    'price'          => 0,
                    'original_price' => 0,
                    'position'       => 1,
                    'uk'             => ['name' => 'Самовивіз з магазину'],
                    'ru'             => ['name' => 'Cамовывоз из магазина'],
                ],
                [
                    'currency_id'    => $currencies->random()->id,
                    'is_active'      => true,
                    'is_default'     => false,
                    'type'           => DeliveryType::PICKUP_NP,
                    'price'          => 20.5,
                    'original_price' => 20.5,
                    'position'       => 2,
                    'uk'             => ['name' => 'Самовивіз з Нової пошти'],
                    'ru'             => ['name' => 'Самовывоз из Новой почты'],
                ],
                [
                    'currency_id'    => $currencies->random()->id,
                    'is_active'      => true,
                    'is_default'     => false,
                    'type'           => DeliveryType::COURIER_NP,
                    'price'          => 20,
                    'original_price' => 20,
                    'position'       => 3,
                    'uk'             => ['name' => 'Кур\'єр Нової пошти'],
                    'ru'             => ['name' => 'Курьер Новой почты'],
                ],
                [
                    'currency_id'    => $currencies->random()->id,
                    'is_active'      => true,
                    'is_default'     => false,
                    'type'           => DeliveryType::DELIVERY_COMPANY,
                    'price'          => 10,
                    'original_price' => 10,
                    'position'       => 5,
                    'uk'             => ['name' => 'Інші транспортні компанії'],
                    'ru'             => ['name' => 'Другие транспортные компании'],
                ],

            ];

            foreach ($deliveries as $delivery) {
                Delivery::create($delivery);
            }

            dispatch(new GetCitiesNPJob('ru'));
        }
    }
