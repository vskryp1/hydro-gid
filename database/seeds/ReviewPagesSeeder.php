<?php

    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;

    class ReviewPagesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $reviewPageTemplate = PageTemplate::create([
                'name'        => 'Отзыв',
                'folder'      => 'review',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $reviewPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'reviews',
                'position'         => 9,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Отзывы',
                ],
                'uk'               => [
                    'name' => 'Відгуки',
                ],
            ]);
        }
    }
