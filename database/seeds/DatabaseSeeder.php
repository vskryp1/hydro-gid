<?php

    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        public function run(): void
        {
            $this->call([
                LanguagesSeeder::class,
                CurrenciesSeeder::class,
                RolesSeeder::class,
                UsersSeeder::class,
                StockSeeder::class,
                CompareSeeder::class,
                BlogSeeder::class,
                PagesSeeder::class,
                SeoRobotsSeeds::class,
                SettingsSeeder::class,
                RegionsSeeder::class,
                CatalogSeeder::class,
                ServicesSeeder::class,
                MenuSeeder::class,
                CurrenciesSeeder::class,
                ProductStatusesSeeder::class,
                FiltersSeeder::class,
                ProductsSeeder::class,
                ClientsSeeder::class,
                CalculatorPagesSeeder::class,
                OrderStatusesSeeder::class,
                PaymentsSeeder::class,
                DeliveriesSeeder::class,
                ReviewPagesSeeder::class,
                CertificatesSeeder::class,
                SliderSeeder::class,
                ProductStatusesAliasSeeder::class,
                FixSeeder::class,
                UpdateCategoriesSeeder::class,
                UpdateBlogSeeder::class,
                UpdateServiceSeeder::class,
            ]);
        }
    }
