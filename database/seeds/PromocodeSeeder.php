<?php

    use App\Models\Currency\Currency;
    use App\Models\Product\Promocode;
    use Carbon\Carbon;
    use Illuminate\Database\Seeder;

    /**
     * Class PromocodeSeeder
     */
    class PromocodeSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $currencies = Currency::all();
            $promocodes = [
                [
                    'alias'                  => 'TESTME',
                    'type'                   => Promocode::PERCENT,
                    'currency_id'            => $currencies->random()->id,
                    'original_discount_size' => 10,
                    'discount_size'          => 10,
                    'use_count'              => 100,
                    'type_of_use'            => false,
                    'expiration_date'        => Carbon::now()->addYear(),
                    'active'                 => true,
                ], [
                    'alias'                  => 'NY2019',
                    'type'                   => Promocode::AMOUNT,
                    'currency_id'            => $currencies->random()->id,
                    'original_discount_size' => 2019,
                    'discount_size'          => 2019,
                    'use_count'              => 100,
                    'type_of_use'            => false,
                    'expiration_date'        => Carbon::now()->addMonth(),
                    'active'                 => true,
                ], [
                    'alias'                  => 'BLACKFRIDAY',
                    'type'                   => Promocode::PERCENT,
                    'currency_id'            => $currencies->random()->id,
                    'original_discount_size' => 20,
                    'discount_size'          => 20,
                    'use_count'              => 10,
                    'type_of_use'            => false,
                    'expiration_date'        => Carbon::now()->addMonths(6),
                    'active'                 => true,
                ], [
                    'alias'                  => 'ARTJOKER',
                    'type'                   => Promocode::AMOUNT,
                    'currency_id'            => $currencies->random()->id,
                    'original_discount_size' => 500,
                    'discount_size'          => 500,
                    'use_count'              => 0,
                    'type_of_use'            => true,
                    'expiration_date'        => Carbon::now()->addYear(),
                    'active'                 => true,
                ],

            ];
            foreach ($promocodes as $promocode) {
                Promocode::create($promocode);
            }
        }
    }
