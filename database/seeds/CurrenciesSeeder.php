<?php

    use App\Models\Currency\Currency;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Str;

    /**
     * Class CurrenciesSeeder
     */
    class CurrenciesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            Currency::insert([
                [
                    'id'       => Str::uuid()->toString(),
                    'position' => 1,
                    'code'     => 'UAH',
                    'name'     => 'UAH',
                    'sign'     => 'грн',
                    'default'  => true,
                ],
            ]);

            Currency::all()->each(function($currency) {
                $currency->courses()->create(['course' => 1]);
            });

            Artisan::call('currencies:course');
        }
    }
