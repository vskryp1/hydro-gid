<?php

    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;

    class CalculatorPagesSeeder extends Seeder
    {
        public function run(): void
        {
            $calculatorPageTemplate = PageTemplate::create([
                'name'        => 'Калькулятор',
                'folder'      => 'calculator',
                'active'      => true,
                'is_category' => false,
            ]);

            $calculatorPage = Page::create([
                'page_template_id' => $calculatorPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'calculators',
                'position'         => 8,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Калькуляторы',
                ],
                'uk'               => [
                    'name' => 'Калькулятори',
                ],
            ]);

            $calculatorChildrenPageTemplate = PageTemplate::create([
                'name'        => 'Калькулятор (внутренняя)',
                'folder'      => 'calculator.inner',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $calculatorChildrenPageTemplate->id,
                'parent_page_id'   => $calculatorPage->id,
                'alias'            => 'calculators/drive',
                'position'         => 1,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Привод',
                ],
                'uk'               => [
                    'name' => 'Привід',
                ],
            ]);

            Page::create([
                'page_template_id' => $calculatorChildrenPageTemplate->id,
                'parent_page_id'   => $calculatorPage->id,
                'alias'            => 'calculators/hydraulic',
                'position'         => 2,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Гидроцилиндр',
                ],
                'uk'               => [
                    'name' => 'Гідроциліндр',
                ],
            ]);

            Page::create([
                'page_template_id' => $calculatorChildrenPageTemplate->id,
                'parent_page_id'   => $calculatorPage->id,
                'alias'            => 'calculators/pipeline',
                'position'         => 3,
                'active'           => false,
                'only_auth'        => false,
                'use_sitemap'      => false,
                'ru'               => [
                    'name' => 'Трубопровод',
                ],
                'uk'               => [
                    'name' => 'Трубопривід',
                ],
            ]);
        }
    }
