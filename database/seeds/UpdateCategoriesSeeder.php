<?php

    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;
    use App\Models\Page\PageAdditionalField;
    use App\Models\Page\PageAdditionalFieldType;

    /**
     * Class UpdateCategoriesSeeder
     */
    class UpdateCategoriesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            // add pictures to categories
            $pageTemplate = PageTemplate::where('folder', 'category')->first();
            if ($pageTemplate) {
                PageAdditionalField::updateOrCreate(['key' => 'page_image'], [
                    'page_template_id'              => $pageTemplate->id,
                    'key'                           => 'page_image',
                    'page_additional_field_type_id' => PageAdditionalFieldType::where('type', 'file')->first()->id,
                    'name'                          => 'картинка категории',
                ]);
            }
        }
    }
