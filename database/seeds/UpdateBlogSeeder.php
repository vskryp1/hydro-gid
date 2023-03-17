<?php

    use App\Helpers\SeedHelper;
    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;
    use App\Models\Page\PageAdditionalField;
    use App\Models\Page\PageAdditionalFieldType;

    /**
     * Class UpdateBlogSeeder
     */
    class UpdateBlogSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $parentBlogPage = Page::where('alias', 'blog')->first();
            if ($parentBlogPage) {
                $blogPageTemplate = PageTemplate::where('folder', 'blog')->first();
                $blogPages        = $parentBlogPage->children;
                $blogCategoryPage = Page::create([
                    'page_template_id' => $blogPageTemplate->id,
                    'parent_page_id'   => $parentBlogPage->id,
                    'alias'            => 'blog-category',
                    'position'         => 1,
                    'active'           => true,
                    'only_auth'        => false,
                    'use_sitemap'      => true,
                    'ru'               => [
                        'name' => 'Категория блога',
                    ],
                    'uk'               => [
                        'name' => 'Категорія блога',
                    ],
                ]);

                foreach ($blogPages as $blogPage) {
                    $blogPage->parent_page_id = $blogCategoryPage->id;
                    $blogPage->save();
                }
            }
        }
    }
