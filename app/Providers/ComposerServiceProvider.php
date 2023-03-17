<?php

namespace App\Providers;

use App\Helpers\CategoryHelper;
use App\Enums\PageAlias;
use App\Helpers\PageHelper;
use App\Helpers\ShopHelper;
use App\Models\Page\Page;
use App\Singletons\BreadcrumbsData;
use App\Singletons\OgMetaData;
use App\Singletons\SchemaOrgData;
use App\Singletons\SeoMetaData;
use App\Singletons\SeoPaginateData;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\SchemaOrg\Schema;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['frontend.elements.breadcrumbs'], function (View $view) {
            $view->with([
                'breadcrumbs' => app(BreadcrumbsData::class)->getBreadcrumbs(),
            ]);
        });

        view()->composer(['frontend.elements.localBusiness'], function (View $view) {
            $schema_org = app(SchemaOrgData::class);
            $schema_org->setLocalBusiness(
                Schema::localBusiness()
                    ->leiCode(ShopHelper::setting('postal-code'))
                    ->foundingLocation(ShopHelper::setting('region-code'))
                    ->location(head(explode(',', ShopHelper::setting('site_address'))))
                    ->address(implode(',', array_slice(explode(',', ShopHelper::setting('site_address')), 1)))
                    ->name(ShopHelper::setting('site_name'))
                    ->description(ShopHelper::setting('business-description'))
                    ->telephone(ShopHelper::setting('phone_number_first'))
                    ->openingHours(ShopHelper::getSchedule())
                    ->longitude(\Setting::get('site_geo')['lng'])
                    ->latitude(\Setting::get('site_geo')['lat'])
                    ->image(url('/assets/frontend/images/logo@2.png'))
                    ->sameAs([
                        ShopHelper::setting('facebook_link'),
                        ShopHelper::setting('instagram_link'),
                        ShopHelper::setting('linkedin_link'),
                        ShopHelper::setting('telegram_link'),
                        ShopHelper::setting('skype_link'),
                        ShopHelper::setting('viber_link')
                    ])
                    ->priceRange(__('frontend/product/index.uah'))
            );

            $view->with([
                'schema_org'   => $schema_org->getAllData(),
            ]);
        });

        view()->composer(['frontend.*'], function (View $view) {

            $og_meta      = app(OgMetaData::class);
            $seo_meta     = app(SeoMetaData::class);
            $seo_paginate = app(SeoPaginateData::class);

            $view->with([
                            'og_meta'      => $og_meta->getAllData(),
                            'seo_meta'     => $seo_meta->getAllData(),
                            'seo_paginate' => $seo_paginate->getAllData(),
                        ]);
        });

        view()->composer(['frontend.elements.text-block'], function (View $view) {
            $seo_meta = app(SeoMetaData::class);

            $view->with([
                            'seo_meta' => $seo_meta->getAllData(),
                        ]);
        });

        view()->composer(['frontend.templates.main.index'], function (View $view) {
            $page            = Page::onlyActive()->catalog()->first();
            $categories      = CategoryHelper::getChildren($page->id);
            $bigCategories   = $categories->take(4);
            $smallCategories = $categories->slice(4)->all();

            $view->with([
                            'bigCategories'   => $bigCategories,
                            'smallCategories' => collect($smallCategories),
                            'services'        => ShopHelper::getServices(),
                            'mainServices'   => ShopHelper::getMainServices(),
                        ]);
        });

        view()->composer(['frontend.elements.header.header'], function (View $view) {
            $current_url        = \Illuminate\Support\Facades\Request::url();
            $localized_url      = LaravelLocalization::getLocalizedURL(App::getLocale(), url(DIRECTORY_SEPARATOR));

	        $topHeadLinks = collect(
		        [
			        [
				        'href'   => route('frontend.page', PageAlias::PAGE_ABOUT_US),
				        'name'   => __('frontend/content/index.about_us'),
				        'alias'  => PageAlias::PAGE_ABOUT_US,
				        'active' => PageHelper::isActivePage(PageAlias::PAGE_ABOUT_US),
			        ],
			        [
				        'href'   => route('frontend.page', PageAlias::PAGE_BLOG),
				        'name'   => __('frontend/content/index.blog'),
				        'alias'  => PageAlias::PAGE_BLOG,
				        'active' => PageHelper::isActivePage(PageAlias::PAGE_BLOG),
			        ],
			        [
				        'href'   => route('frontend.page', PageAlias::PAGE_CERTIFICATES),
				        'name'   => __('frontend/content/index.certificates'),
				        'alias'  => PageAlias::PAGE_CERTIFICATES,
				        'active' => PageHelper::isActivePage(PageAlias::PAGE_CERTIFICATES),
			        ],
			        [
				        'href'   => route('frontend.page', PageAlias::PAGE_REVIEWS),
				        'name'   => __('frontend/content/index.reviews'),
				        'alias'  => PageAlias::PAGE_REVIEWS,
				        'active' => PageHelper::isActivePage(PageAlias::PAGE_REVIEWS),
			        ],
			        [
				        'href'   => route('frontend.page', PageAlias::PAGE_FAQ),
				        'name'   => __('frontend/content/index.faqs'),
				        'alias'  => PageAlias::PAGE_FAQ,
				        'active' => PageHelper::isActivePage(PageAlias::PAGE_FAQ),
			        ],
                    [
                        'href'   => route('frontend.page', PageAlias::PAGE_OFERTA),
                        'name'   => __('frontend/content/index.oferta'),
                        'alias'  => PageAlias::PAGE_OFERTA,
                        'active' => PageHelper::isActivePage(PageAlias::PAGE_OFERTA),
                    ],
		        ]
	        );

	        $bottomHeadLinks = collect(
		        [
			        [
				        'href'   => route('frontend.page', PageAlias::PAGE_PROMOTIONS),
				        'name'   => __('frontend.promotions'),
				        'active' => PageHelper::isActivePage(PageAlias::PAGE_PROMOTIONS),
				        'alias'  => PageAlias::PAGE_PROMOTIONS,
			        ],
			        [
				        'href'   => route('frontend.page', PageAlias::PAGE_PAYMENTS_AND_DELIVERIES),
				        'name'   => __('frontend.payment_and_delivery'),
				        'active' => PageHelper::isActivePage(PageAlias::PAGE_PAYMENTS_AND_DELIVERIES),
				        'alias'  => PageAlias::PAGE_PAYMENTS_AND_DELIVERIES,
			        ],
			        [
				        'href'   => route('frontend.page', PageAlias::PAGE_CONTACTS),
				        'name'   => __('frontend.contacts'),
				        'active' => PageHelper::isActivePage(PageAlias::PAGE_CONTACTS),
				        'alias'  => PageAlias::PAGE_CONTACTS,
			        ],
		        ]
	        );

            $view->with([
                            'services'  => ShopHelper::getServices(),
	                        'topHeadLinks' => $topHeadLinks->where('active', true),
	                        'bottomHeadLinks' => $bottomHeadLinks->where('active', true),
                            'current_url'  => $current_url,
                            'localized_url'  => $localized_url,
                        ]);
        });

        view()->composer(['frontend.elements.footer.footer'], function (View $view) {
            $page         = Page::onlyActive()->catalog()->first();
            $categories   = CategoryHelper::getChildren($page->id);
            $forClients   = collect(
                [
	                [
		                'href'   => route('frontend.page', PageAlias::PAGE_PAYMENTS_AND_DELIVERIES),
		                'name'   => __('frontend.payment_and_delivery'),
		                'active' => PageHelper::isActivePage(PageAlias::PAGE_PAYMENTS_AND_DELIVERIES),
		                'alias'  => PageAlias::PAGE_PAYMENTS_AND_DELIVERIES,
	                ],
	                [
		                'href'   => route('frontend.page', PageAlias::PAGE_FAQ),
		                'name'   => __('frontend/content/index.faqs'),
		                'active' => PageHelper::isActivePage(PageAlias::PAGE_FAQ),
		                'alias'  => PageAlias::PAGE_FAQ,
	                ],
                ]
            );
            $aboutCompany = collect(
                [
	                [
		                'href'   => route('frontend.page', PageAlias::PAGE_ABOUT_US),
		                'name'   =>  __('frontend/content/index.about_us'),
		                'active' => PageHelper::isActivePage(PageAlias::PAGE_ABOUT_US),
		                'alias'  => PageAlias::PAGE_ABOUT_US,
	                ],
	                [
		                'href'   => route('frontend.page', PageAlias::PAGE_BLOG),
		                'name'   => __('frontend/content/index.blog'),
		                'active' => PageHelper::isActivePage(PageAlias::PAGE_BLOG),
		                'alias'  => PageAlias::PAGE_BLOG,
	                ],
	                [
		                'href'   => route('frontend.page', PageAlias::PAGE_CONTACTS),
		                'name'   => __('frontend/content/index.contacts'),
		                'active' => PageHelper::isActivePage(PageAlias::PAGE_CONTACTS),
		                'alias'  => PageAlias::PAGE_CONTACTS,
	                ],
                    [
                        'href'   => route('frontend.page', PageAlias::PAGE_SITEMAP),
                        'name'   => __('frontend/content/index.sitemap'),
                        'active' => PageHelper::isActivePage(PageAlias::PAGE_SITEMAP),
                        'alias'  => PageAlias::PAGE_SITEMAP,
                    ]
                ]
            );

            $view->with([
                            'categories'   => $categories,
                            'services'     => ShopHelper::getServices(),
                            'forClients'   => $forClients->where('active', true),
                            'aboutCompany' => $aboutCompany->where('active', true),
                        ]);
        });
    }

    public function register()
    {
    }
}
