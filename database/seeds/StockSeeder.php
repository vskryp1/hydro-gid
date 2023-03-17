<?php

    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use App\Models\Stock\Stock;
    use Illuminate\Database\Seeder;
    use Carbon\Carbon;
    use App\Helpers\SeedHelper;
    use App\Models\Product\Product;
    /**
     * Class BlogSeeder
     */
    class StockSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $stockPageTemplate = PageTemplate::create([
                'name'        => 'Шаблон акций',
                'folder'      => 'stock',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $stockPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'promotions',
                'position'         => 2,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Акции',
                ],
                'uk'               => [
                    'name' => 'Акції',
                ],
            ]);

            for ($i = 1; $i < 10; $i++) {
                $stock = Stock::create([
                    'active'          => true,
                    'start_date'      => Carbon::now(),
                    'expiration_date' => Carbon::now()->addDays(10),
                    'image'           => 'stock.png',
                    'position'        => $i,
                    'ru'              => [
                        'name'        => 'Супер цена! Длинный заголовок, возможно на две строки',
                        'description' => 'Таким образом консультация с широким активом позволяет выполнять важные задания по
                            разработке дальнейших направлений развития. Не следует, однако забывать, что дальнейшее
                            развитие различных форм деятельности требуют определения и уточнения существенных финансовых
                            и административных условий. Не следует, однако забывать, что постоянное
                            информационно-пропагандистское обеспечение нашей деятельности в значительной степени
                            обуславливает создание модели развития. Повседневная практика показывает, что рамки и место
                            обучения кадров требуют от нас анализа новых предложений. С другой стороны постоянное',
                    ],
                    'uk'              => [
                        'name'        => 'Супер ціна! Длинний заголовник, можливо на дві строки',
                        'description' => 'Таким чином, консультація з широким активом дозволяє виконати важливі завдання по
                            розробляти дальнейших напрямків розвитку. Не слід, однако забути, що дальнейше
                            розробка різних форм вимагає визначення та уточнення істотних фінансових показників
                            і адміністративні услови. Не слід, однако забути, що постійне
                            інформаційно-пропагандистське забезпечення нашої діяльності у значній степені
                            взуття створює моделі розвитку. Повседневна практика показує, що рамки і місце
                            взуття кадрів вимагає від нас аналізу нових пропозицій. З іншою стороною постійного',
                    ],
                ]);
                SeedHelper::copyFile($stock->id, 'stock.png', Stock::GALLERY_PATH);
            }
        }
    }
