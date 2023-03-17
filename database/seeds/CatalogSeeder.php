<?php

    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;

    class CatalogSeeder extends Seeder
    {
        public function run(): void
        {
            $catalogPageTemplate = PageTemplate::create([
                'name'        => 'Каталог',
                'folder'      => 'catalog',
                'active'      => true,
                'is_category' => false,
            ]);

            $catalogPage = Page::create([
                'page_template_id' => $catalogPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'catalog',
                'position'         => 2,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Каталог',
                ],
                'uk'               => [
                    'name' => 'Каталог',
                ],
            ]);

            $categoryPageTemplate = PageTemplate::create([
                'name'        => 'Категории и подкатегории',
                'folder'      => 'category',
                'active'      => true,
                'is_category' => true,
            ]);

            $gidravlicheskieNasosyPage = Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $catalogPage->id,
                'alias'            => 'gidravlicheskie-nasosy',
                'position'         => 1,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Гидравлические насосы',
                ],
                'uk'               => [
                    'name' => 'Гідравлічні насоси',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidravlicheskieNasosyPage->id,
                'alias'            => 'aksialno-porshnevye-nasosy',
                'position'         => 1,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Аксиально-поршневые насосы',
                ],
                'uk'               => [
                    'name' => 'Аксіально-поршневі насоси',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidravlicheskieNasosyPage->id,
                'alias'            => 'shesterenchatye-nasosy',
                'position'         => 2,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Шестеренчатые насосы',
                ],
                'uk'               => [
                    'name' => 'Шестерні насоси',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidravlicheskieNasosyPage->id,
                'alias'            => 'sekcionnye-nasosy',
                'position'         => 3,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Секционные насосы',
                ],
                'uk'               => [
                    'name' => 'Секційні насоси',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidravlicheskieNasosyPage->id,
                'alias'            => 'ruchnye-gidravlicheskie-nasosy',
                'position'         => 4,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Ручные гидравлические насосы',
                ],
                'uk'               => [
                    'name' => 'Ручні гідравлічні насоси',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidravlicheskieNasosyPage->id,
                'alias'            => 'plastinchatye-nasosy',
                'position'         => 5,
                'active'           => false,
                'only_auth'        => false,
                'use_sitemap'      => false,
                'ru'               => [
                    'name' => 'Пластинчатые насосы',
                ],
                'uk'               => [
                    'name' => 'Пластинчасті насоси',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidravlicheskieNasosyPage->id,
                'alias'            => 'radialno-porshnevye-nasosy',
                'position'         => 6,
                'active'           => false,
                'only_auth'        => false,
                'use_sitemap'      => false,
                'ru'               => [
                    'name' => 'Радиально поршневые насосы',
                ],
                'uk'               => [
                    'name' => 'Радіально поршневі насоси',
                ],
            ]);

            $gidroraspredeliteliPage = Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $catalogPage->id,
                'alias'            => 'gidroraspredeliteli',
                'position'         => 2,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Гидрораспределители',
                ],
                'uk'               => [
                    'name' => 'Гідророзподільники',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidroraspredeliteliPage->id,
                'alias'            => 'elektromagnitnye-gidroraspredeliteli',
                'position'         => 1,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Электромагнитные гидрораспределители',
                ],
                'uk'               => [
                    'name' => 'Електромагнітні гідророзподільники',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidroraspredeliteliPage->id,
                'alias'            => 'gidroraspredeliteli-s-ruchnym-upravleniem',
                'position'         => 2,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Гидрораспределители с ручным управлением',
                ],
                'uk'               => [
                    'name' => 'Гідророзподільники з ручним керуванням',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidroraspredeliteliPage->id,
                'alias'            => 'sekcionnye-gidroraspredeliteli',
                'position'         => 3,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Секционные гидрораспределители',
                ],
                'uk'               => [
                    'name' => 'Секційні гідророзподільники',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidroraspredeliteliPage->id,
                'alias'            => 'monoblochnye-gidroraspredeliteli',
                'position'         => 4,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Моноблочные гидрораспределители',
                ],
                'uk'               => [
                    'name' => 'Моноблочні гідророзподільники',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidroraspredeliteliPage->id,
                'alias'            => 'divertory',
                'position'         => 5,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Диверторы',
                ],
                'uk'               => [
                    'name' => 'Дивертора',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidroraspredeliteliPage->id,
                'alias'            => 'aksessuary',
                'position'         => 6,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Аксессуары',
                ],
                'uk'               => [
                    'name' => 'Аксесуари',
                ],
            ]);

            $gidromotoryPage = Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $catalogPage->id,
                'alias'            => 'gidromotory',
                'position'         => 3,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Гидромоторы',
                ],
                'uk'               => [
                    'name' => 'Гідромотори',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidromotoryPage->id,
                'alias'            => 'aksialno-porshnevye-gidromotory',
                'position'         => 1,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Аксиально-поршневые гидромоторы',
                ],
                'uk'               => [
                    'name' => 'Аксіально-поршневі гідромотори',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidromotoryPage->id,
                'alias'            => 'gidromotory-shesterennye',
                'position'         => 2,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Гидромоторы шестеренные',
                ],
                'uk'               => [
                    'name' => 'Гідромотори шестерінчасті',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidromotoryPage->id,
                'alias'            => 'gerotornye-gidromotory',
                'position'         => 3,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Героторные гидромоторы',
                ],
                'uk'               => [
                    'name' => 'Героторні гідромотори',
                ],
            ]);

            $gidroakkumulyatoryPage = Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $catalogPage->id,
                'alias'            => 'gidroakkumulyatory',
                'position'         => 4,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Гидроаккумуляторы',
                ],
                'uk'               => [
                    'name' => 'Гідроакумулятори',
                ],
            ]);

            Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $gidroakkumulyatoryPage->id,
                'alias'            => 'ustrojstva-dlya-zaryadki',
                'position'         => 1,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Устройства для зарядки',
                ],
                'uk'               => [
                    'name' => 'Пристрої для зарядки',
                ],
            ]);

            $manometryPage = Page::create([
                'page_template_id' => $categoryPageTemplate->id,
                'parent_page_id'   => $catalogPage->id,
                'alias'            => 'manometry',
                'position'         => 5,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Манометры',
                ],
                'uk'               => [
                    'name' => 'Манометри',
                ],
            ]);
        }
    }
