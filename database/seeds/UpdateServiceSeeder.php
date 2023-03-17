<?php

use App\Models\Page\Page;
use App\Models\Page\PageTemplate;
use Illuminate\Database\Seeder;
use App\Models\Page\PageAdditionalFieldType;

/**
 * Class CertificatesSeeder
 */
class UpdateServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $servicePageTemplate = PageTemplate::where('folder', 'service')->first();
        if ($servicePageTemplate) {


            $type = PageAdditionalFieldType::create(
                [
                    'type'   => 'checkbox',
                    'active' => true,
                ]
            );


            $field = $servicePageTemplate
                ->page_additional_field()
                ->create([
                             'name'                          => 'Показывать на главной в слайдере',
                             'key'                           => 'show_on_main_page',
                             'active'                        => true,
                             'default'                       => true,
                             'page_additional_field_type_id' => $type->id,
                         ]);

            $pages = Page::where('page_template_id', $servicePageTemplate->id)->get();

            foreach ($pages as $page) {
                $page->additional_field_values()
                     ->create([
                                  'page_additional_field_id' => $field->id,
                                  'ru'                       => [
                                      'value' => true,
                                  ],
                                  'uk'                       => [
                                      'value' => true,
                                  ],
                              ]);
            }
        }
    }
}
