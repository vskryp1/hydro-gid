<?php

    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;

    /**
     * Class BlogSeeder
     */
    class CompareSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $compareCartTemplate = PageTemplate::create([
                'name'        => 'Шаблон корзины сравнения',
                'folder'      => 'compare_cart',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $compareCartTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'compare-list',
                'position'         => 15,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Корзина сравнения товаров',
                ],
                'uk'               => [
                    'name' => 'Кошик порівняння товарів',
                ],
            ]);

            $compareTemplate = PageTemplate::create([
                'name'        => 'Шаблон страницы сравнения товаров',
                'folder'      => 'compare',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $compareTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'compare-products',
                'position'         => 24,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Сравнение товаров',
                ],
                'uk'               => [
                    'name' => 'Порівняння товарів',
                ],
            ]);

        }
    }
