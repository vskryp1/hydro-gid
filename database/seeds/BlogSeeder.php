<?php

    use App\Helpers\SeedHelper;
    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;
    use App\Models\Page\PageAdditionalField;
    use App\Models\Page\PageAdditionalFieldType;

    /**
     * Class BlogSeeder
     */
    class BlogSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $blogPages        = [];
            $blogPageTemplate = PageTemplate::create([
                'name'        => 'Шаблон блога',
                'folder'      => 'blog',
                'active'      => true,
                'is_category' => false,
            ]);

            $blogParentPage = Page::create([
                'page_template_id' => $blogPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'blog',
                'position'         => 3,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Блог',
                ],
                'uk'               => [
                    'name' => 'Блог',
                ],
            ]);

            $blogOnePageTemplate = PageTemplate::create([
                'name'        => 'Шаблон статьи',
                'folder'      => 'blog_one',
                'active'      => true,
                'is_category' => false,
            ]);

            $blogPages[] = Page::create([
                'page_template_id' => $blogOnePageTemplate->id,
                'parent_page_id'   => $blogParentPage->id,
                'alias'            => 'gidravlica',
                'position'         => 1,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Cтатья по гидрораспредилителям (гидравлика)',
                ],
                'uk'               => [
                    'name' => 'Стаття по гідророзподільникам (гідравліка)',
                ],
            ]);

            $blogPages[] = Page::create([
                'page_template_id' => $blogOnePageTemplate->id,
                'parent_page_id'   => $blogParentPage->id,
                'alias'            => 'pumps',
                'position'         => 2,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Cтатья про насосы (гидравлика)',
                ],
                'uk'               => [
                    'name' => 'Стаття про насоси (гідравліка)',
                ],
            ]);

            $blogPages[] = Page::create([
                'page_template_id' => $blogOnePageTemplate->id,
                'parent_page_id'   => $blogParentPage->id,
                'alias'            => 'power-choice',
                'position'         => 3,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Cтатья про выбор мощности (гидравлика)',
                ],
                'uk'               => [
                    'name' => 'Стаття про вибір потужності (гідравліка)',
                ],
            ]);

            $blogPages[] = Page::create([
                'page_template_id' => $blogOnePageTemplate->id,
                'parent_page_id'   => $blogParentPage->id,
                'alias'            => 'hydraulic-cylinder-choiсe',
                'position'         => 4,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Статья про выбор гидроцилиндра (гидравлика)',
                ],
                'uk'               => [
                    'name' => 'Стаття про вибір гідроциліндра (гідравліка)',
                ],
            ]);

            $blogPages[] = Page::create([
                'page_template_id' => $blogOnePageTemplate->id,
                'parent_page_id'   => $blogParentPage->id,
                'alias'            => 'sertificate-news',
                'position'         => 5,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name'        => 'ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001',
                    'description' => '<p>
                                        Равным образом дальнейшее развитие различных форм деятельности требуют определения и уточнения направлений прогрессивного развития. Равным образом новая модель организационной деятельности влечет за собой процесс внедрения и модернизации систем массового участия. Значимость этих проблем настолько очевидна, что постоянное информационно-пропагандистское обеспечение нашей деятельности требуют от нас анализа новых предложений.
                                      </p>
                                      <p>
                                        Значимость этих проблем настолько очевидна, что рамки и место обучения кадров обеспечивает широкому кругу (специалистов) участие в формировании модели развития. Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности требуют определения и уточнения дальнейших направлений развития. Не следует, однако забывать, что постоянный количественный рост и сфера нашей активности требуют определения и уточнения модели развития. Идейные соображения высшего порядка, а также новая модель организационной деятельности влечет за собой процесс внедрения и модернизации системы обучения кадров, соответствует насущным потребностям. Идейные соображения высшего порядка, а также реализация намеченных плановых заданий позволяет оценить значение существенных финансовых и административных условий. Разнообразный и богатый опыт дальнейшее развитие различных форм деятельности требуют определения и уточнения соответствующий условий активизации.
                                      </p>',
                ],
                'uk'               => [
                    'name'        => 'ОО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001',
                    'description' => '<p>Равным образом дальнейшее развитие различных форм деятельности требуют определения и уточнения направлений прогрессивного развития. Равным образом новая модель организационной деятельности влечет за собой процесс внедрения и модернизации систем массового участия. Значимость этих проблем настолько очевидна, что постоянное информационно-пропагандистское обеспечение нашей деятельности требуют от нас анализа новых предложений.
                                      </p>
                                      <p>Значимость этих проблем настолько очевидна, что рамки и место обучения кадров обеспечивает широкому кругу (специалистов) участие в формировании модели развития. Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности требуют определения и уточнения дальнейших направлений развития. Не следует, однако забывать, что постоянный количественный рост и сфера нашей активности требуют определения и уточнения модели развития. Идейные соображения высшего порядка, а также новая модель организационной деятельности влечет за собой процесс внедрения и модернизации системы обучения кадров, соответствует насущным потребностям. Идейные соображения высшего порядка, а также реализация намеченных плановых заданий позволяет оценить значение существенных финансовых и административных условий. Разнообразный и богатый опыт дальнейшее развитие различных форм деятельности требуют определения и уточнения соответствующий условий активизации.
                                      </p>',
                ],
            ]);

            $addField = PageAdditionalField::updateOrCreate(['key' => 'image'], [
                'page_template_id'              => $blogPageTemplate->id,
                'key'                           => 'image',
                'page_additional_field_type_id' => PageAdditionalFieldType::where('type', 'file')->first()->id,
                'name'                          => 'картинка блога',
            ]);

            foreach ($blogPages as $blogPage) {
                SeedHelper::createAddFieldValue($blogPage, $addField, 'blog.jpg');
            }
        }
    }
