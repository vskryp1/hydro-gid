<?php

    use App\Models\Faq\Faq;
    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;

    /**
     * Class PagesSeeder
     */
    class PagesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $mainPageTemplate = PageTemplate::create([
                'name'        => 'Главная страница',
                'folder'      => 'main',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $mainPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => DIRECTORY_SEPARATOR,
                'position'         => 1,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Главная страница',
                ],
                'uk'               => [
                    'name' => 'Головна сторінка',
                ],
            ]);

            $contentPageTemplate = PageTemplate::create([
                'name'        => 'Контентные страницы',
                'folder'      => 'content',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $contentPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'payments-and-deliveries',
                'position'         => 5,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Доставка и оплата',
                ],
                'uk'               => [
                    'name' => 'Доставка і оплата',
                ],
            ]);

            $contactsPageTemplate = PageTemplate::create([
                'name'        => 'Контакты',
                'folder'      => 'contacts',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $contactsPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'contacts',
                'position'         => 6,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Контакты',
                ],
                'uk'               => [
                    'name' => 'Контакти',
                ],
            ]);

            $accountPageTemplate = PageTemplate::create([
                'name'        => 'Личный кабинет',
                'folder'      => 'account',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $accountPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'account',
                'position'         => 7,
                'active'           => true,
                'only_auth'        => true,
                'use_sitemap'      => false,
                'ru'               => [
                    'name' => 'Личный кабинет',
                ],
                'uk'               => [
                    'name' => 'Особистий кабінет',
                ],
            ]);

            $searchPageTemplate = PageTemplate::create([
                'name'        => 'Шаблон поиска',
                'folder'      => 'search',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $searchPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'search',
                'position'         => 8,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Cтраница поиска',
                ],
                'uk'               => [
                    'name' => 'Сторінка пошуку',
                ],
            ]);

            $basketPageTemplate = PageTemplate::create([
                'name'        => 'Шаблон корзины',
                'folder'      => 'basket',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $basketPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'basket',
                'position'         => 9,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Cтраница корзины',
                ],
                'uk'               => [
                    'name' => 'Сторінка кошику',
                ],
            ]);

            $checkoutStep1PageTemplate = PageTemplate::create([
                'name'        => 'Шаблон заказа - шаг 1',
                'folder'      => 'checkout_step1',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $checkoutStep1PageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'checkout-step1',
                'position'         => 10,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Cтраница оплаты шаг 1',
                ],
                'uk'               => [
                    'name' => 'Сторінка оплати крок 1',
                ],
            ]);

            $checkoutStep2PageTemplate = PageTemplate::create([
                'name'        => 'Шаблон заказа - шаг 2',
                'folder'      => 'checkout_step2',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $checkoutStep2PageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'checkout-step2',
                'position'         => 11,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Cтраница оплаты шаг 2',
                ],
                'uk'               => [
                    'name' => 'Сторінка оплати крок 2',
                ],
            ]);

            $thankYouPageTemplate = PageTemplate::create([
                'name'        => 'Шаблон страницы благодарности',
                'folder'      => 'thankyou',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $thankYouPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'thankyou',
                'position'         => 11,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Cтраница благодарности',
                ],
                'uk'               => [
                    'name' => 'Сторінка подяки',
                ],
            ]);

            $faq = PageTemplate::create([
                'name'        => 'Шаблон страницы вопросы и ответы',
                'folder'      => 'faq',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $faq->id,
                'parent_page_id'   => null,
                'alias'            => 'faq',
                'position'         => 12,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Cтраница вопросы и ответы',
                ],
                'uk'               => [
                    'name' => 'Сторінка питання і відповіді',
                ],
            ]);

            $aboutPageTemplate = PageTemplate::create([
                'name'        => 'Шаблон страницы о компании',
                'folder'      => 'about',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $aboutPageTemplate->id,
                'parent_page_id'   => null,
                'alias'            => 'about-us',
                'position'         => 13,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'О компании',
                ],
                'uk'               => [
                    'name' => 'Про компанію',
                ],
            ]);
    
            $advantages = PageTemplate::create([
                'name'        => 'Преимущества',
                'folder'      => 'advantage',
                'active'      => true,
                'is_category' => false,
            ]);

            Page::create([
                'page_template_id' => $advantages->id,
                'parent_page_id'   => null,
                'alias'            => 'profitable',
                'position'         => 14,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Выгодно',
                ],
                'uk'               => [
                    'name' => 'Вигідно',
                ],
            ]);

            Page::create([
                'page_template_id' => $advantages->id,
                'parent_page_id'   => null,
                'alias'            => 'quickly',
                'position'         => 15,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Быстро',
                ],
                'uk'               => [
                    'name' => 'Швидко',
                ],
            ]);

            Page::create([
                'page_template_id' => $advantages->id,
                'parent_page_id'   => null,
                'alias'            => 'reliably',
                'position'         => 16,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Надежно',
                ],
                'uk'               => [
                    'name' => 'Надійно',
                ],
            ]);

            Page::create([
                'page_template_id' => $advantages->id,
                'parent_page_id'   => null,
                'alias'            => 'professionally',
                'position'         => 17,
                'active'           => true,
                'only_auth'        => false,
                'use_sitemap'      => true,
                'ru'               => [
                    'name' => 'Профессионально',
                ],
                'uk'               => [
                    'name' => 'Професійно',
                ],
            ]);
        }
    }
