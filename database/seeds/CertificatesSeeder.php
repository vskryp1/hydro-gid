<?php

    use App\Helpers\SeedHelper;
    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;
    use App\Models\Page\PageAdditionalField;
    use App\Models\Page\PageAdditionalFieldType;

    /**
     * Class CertificatesSeeder
     */
    class CertificatesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $sertificatesPageTemplate = PageTemplate::create([
                'name'        => 'Шаблон сертификатов',
                'folder'      => 'certificates',
                'active'      => true,
                'is_category' => false,
            ]);

            $page = Page::create([
                'page_template_id' => $sertificatesPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'certificates',
                'position'         => 1,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Сертификаты',
                ],
                'uk'               => [
                    'name' => 'Сертифікати',
                ],
            ]);

            $field = PageAdditionalField::create([
                'name'                          => 'certificate',
                'key'                           => 'certificate',
                'page_template_id'              => $sertificatesPageTemplate->id,
                'active'                        => true,
                'page_additional_field_type_id' => PageAdditionalFieldType::where('type', 'file')->first()->id,
            ]);
            SeedHelper::createAddFieldValue($page, $field, 'certificates.jpg');
        }
    }
