<?php

    use App\Models\Region\Region;
    use Illuminate\Database\Seeder;

    /**
     * Class RegionsSeeder
     */
    class RegionsSeeder extends Seeder
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
                    'is_active'  => true,
                    'is_default' => true,
                    'uk'         => ['name' => 'Україна'],
                    'ru'         => ['name' => 'Украина'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'uk'         => ['name' => 'США'],
                    'ru'         => ['name' => 'США'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'uk'         => ['name' => 'Іспанія'],
                    'ru'         => ['name' => 'Испания'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'uk'         => ['name' => 'Італія'],
                    'ru'         => ['name' => 'Италия'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'uk'         => ['name' => 'Німеччина'],
                    'ru'         => ['name' => 'Германия'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'uk'         => ['name' => 'Інші регіони'],
                    'ru'         => ['name' => 'Другие регионы'],
                ],
            ])->each(function(array $region) {
                Region::create($region);
            });
        }
    }
