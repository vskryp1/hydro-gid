<?php

    use App\Helpers\SeedHelper;
    use App\Models\Page\Page;
    use App\Models\Page\PageAdditionalField;
    use App\Models\Page\PageAdditionalFieldType;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;

    /**
     * Class ServicesSeeder
     */
    class ServicesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $servicesPageTemplate = PageTemplate::create([
                'name'        => 'Шаблон сервисов',
                'folder'      => 'service',
                'active'      => true,
                'is_category' => false,
            ]);

            $field = PageAdditionalField::create([
                'name'                          => 'картинка',
                'key'                           => 'service_image',
                'page_template_id'              => $servicesPageTemplate->id,
                'active'                        => true,
                'page_additional_field_type_id' => PageAdditionalFieldType::where('type', 'file')->first()->id,
            ]);

            $pages       = [
                'service_oil_stations'               => [
                    'ru' => [
                        'name' => 'Изготовление и сервисное обслуживание маслостанций;',
                    ],
                    'uk' => [
                        'name' => 'Виготовлення та сервісне обслуговування маслостанцій;',
                    ],
                ],
                'service_repair_hydraulic_cylinders' => [
                    'ru' => [
                        'name' => 'Производство и ремонт гидроцилиндров',
                    ],
                    'uk' => [
                        'name' => 'Виробництво і ремонт гідроциліндрів',
                    ],
                ],
                'production_oil_press_stations'      => [
                    'ru' => [
                        'name' => 'Изготовление маслостанций для прессов',
                    ],
                    'uk' => [
                        'name' => 'Виготовлення маслостанцій для пресів',
                    ],
                ],
                'oil_station_trawl_hydraulic'        => [
                    'ru' => [
                        'name' => 'Маслостанция для тралла и гидроборта 12 / 24 В',
                    ],
                    'uk' => [
                        'name' => 'Маслостанція для трала та гідроборта 12/24 В',
                    ],
                ],
            ];
            $position    = 0;
            $introtext   = 'Таким образом консультация с широким активом позволяет выполнять важные задания по
                            разработке дальнейших направлений развития. Не следует, однако забывать, что дальнейшее
                            развитие различных форм деятельности требуют определения и уточнения существенных финансовых
                            и административных условий. Не следует, однако забывать, что постоянное
                            информационно-пропагандистское обеспечение нашей деятельности в значительной степени
                            обуславливает создание модели развития. Повседневная практика показывает, что рамки и место
                            обучения кадров требуют от нас анализа новых предложений. С другой стороны постоянное';
            $description = view('frontend.seed.service')->render();

            foreach ($pages as $alias => $pageData) {
                $position++;
                foreach ($pageData as $locale => $data) {
                    $pageData[$locale]['introtext']   = $introtext;
                    $pageData[$locale]['description'] = $description;
                }
                $page = Page::create([
                    'page_template_id' => $servicesPageTemplate->id,
                    'parent_page_id'   => null,
                    'alias'            => $alias,
                    'position'         => $position,
                    'active'           => true,
                    'only_auth'        => false,
                    'use_sitemap'      => true,
                    'ru'               => $pageData['ru'],
                    'uk'               => $pageData['uk'],
                ]);
                SeedHelper::createAddFieldValue($page, $field, "serv-$position.jpg", '');
            }
        }

    }
