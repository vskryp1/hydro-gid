<?php

    namespace App\Http\Middleware;

    use App\Enums\PageAlias;
    use App\Helpers\PageHelper;
    use App\Models\Page\Page;
    use App\Singletons\BreadcrumbsData;
    use App\Singletons\OgMetaData;
    use App\Singletons\PageData;
    use App\Singletons\SeoMetaData;
    use Cache;
    use Closure;
    use LaravelLocalization;

    /**
     * Class PageMiddleware
     *
     * @package App\Http\Middleware
     */
    class PageMiddleware
    {
        public function handle($request, Closure $next)
        {
            if (strpos($request->fullUrl(), 'index.php') !== false) {
                $newUrl = str_replace('index.php', '', $request->fullUrl());

                return redirect($newUrl, 301);
            }

            $alias = $request->route('alias') ?? $request->route()->parameter('alias') ?? Page::HOME_PATH;
            $page  = app(PageData::class);
            $page->setPage(Cache::tags(['pages'])->remember(
                'meta_page.' . md5($alias),
                config('app.cache_minutes'),
                function() use ($alias) {
                    return Page::onlyActive()
                        ->with(['page_template', 'additional_field_values.additional_field'])
                        ->whereAlias($alias)
                        ->first();
                }
            ));

            if ($page->getPage()) {
                //check access to page
                if (
                    $page->getPage()
                    && $page->getPage()->only_auth
                    && ! auth('web')->check()
                ) {
                    return redirect(url('/'), 301);
                }

                //get additional fields
                foreach ($page->getPage()->additional_field_values as $additional_field_value) {
                    $page->addAdditionalField(
                        $additional_field_value->value,
                        $additional_field_value->additional_field->key
                    );
                }

                $intro = strip_tags($page->getPage()->introtext);

                //OG meta tags
                $og_meta = app(OgMetaData::class);
                $og_meta->setOgTitle($page->getPage()->name);
                $og_meta->setOgDescription($intro);
                $og_meta->setOgLocale(LaravelLocalization::getCurrentLocaleRegional());
                $og_meta->setOgUrl($request->url());
                $og_meta->setOgImg($page->getPage()->getImageUrl('page_md', 'page_image'));

                //breadcrumbs
                $breadcrumbs = app(BreadcrumbsData::class);
                $breadcrumbs->setBreadcrumbs(PageHelper::getBreadcrumbsPage($page->getPage()));

                //get meta tags
                $seo_meta = app(SeoMetaData::class);
                if ($seo_meta->isNotStep(SeoMetaData::STEP_MODULE)) {
                    //2 step set meta tags of 4
	                $name = $page->getPage()->name;
	                $template = $page->getPage()->page_template->folder;
	                if($template == 'category') {
		                $template = $this->isSubCategory($page) ? 'sub_category' : $template;
	                }
	                $title = $this->getTitle($page, $seo_meta, $template, $name);
                    $seo_meta->setSeoTitle($title);
                    $seo_meta->setSeoDescription($page->getPage()->seo_description ?? $seo_meta->getSeoInfo('description', $template, ['name' => $name]));
                    $seo_meta->setSeoKeywords($page->getPage()->seo_keywords ?? $seo_meta->getSeoInfo('keywords', $template, ['name' => $name]));
                    $seo_meta->setSeoRobots($page->getPage()->seo_robots);
                    $seo_meta->setSeoCanonical($page->getPage()->seo_canonical ?? $request->url());
                    $seo_meta->setSeoContent($page->getPage()->seo_content);
                    $seo_meta->setStep(SeoMetaData::STEP_PAGE);
                }
	            $seo_meta->setSeoH1($page->getPage()->name);
            } else {
                abort(404);
            }
            return $next($request);
        }

        private function isSubCategory($page) : bool {
	        return $page->getPage()->children_active->isEmpty();
        }

        private function getTitle($page, $seo_meta, $template, $name) : string {
	        return $page->getPage()->seo_title
		        ? $page->getPage()->seo_title
		        : ($seo_meta->getSeoInfo('title', $template, ['name' => $name])
			        ? $seo_meta->getSeoInfo('title', $template, ['name' => $name])
			        : $page->getPage()->name);
        }
    }
