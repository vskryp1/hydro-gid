<?php

    namespace App\Http\Controllers\Frontend;

    use App\Helpers\PageHelper;
    use App\Models\Page\Page;
    use App\Singletons\PageData;
    use App\Singletons\SeoMetaData;
    use App\Singletons\SeoPaginateData;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Response;

    class PageController extends Controller
    {

        public function page(Request $request, string $alias = Page::HOME_PATH, $filters = '')
        {
            $page       = app(PageData::class)->getPage();
            $pageHelper = new PageHelper($page);

            $pageHelper->callAction($request, $filters);
            if ($pageHelper->hasRedirect()) {
                return $pageHelper->getRedirect();
            }
            //Prepare page meta tags
            $current_page = $request->input(config('app.separators.category.pages'));
            //404 if page variable not numeric
            abort_if($current_page != '' && ! is_numeric($current_page), 404);

            //if page not 0 set canonical to prev/next pages
            if ($current_page > 0) {
                $models = $pageHelper->getViewModels();
                //redirect to last page if page more than exists
                //4 step set meta tags of 4
                $seo_meta = app(SeoMetaData::class);
                $seo_meta->setSeoTitle($seo_meta->getSeoTitle() . ' ' . __('frontend.page') . ' ' . $current_page);
                $seo_meta->setSeoDescription($seo_meta->getSeoDescription() . ' ' . __('frontend.page') . ' ' . $current_page);
                $seo_meta->setSeoKeywords($seo_meta->getSeoKeywords());
                $seo_meta->setSeoRobots('noindex,nofollow');
                $seo_meta->setSeoCanonical($request->url());
                $seo_meta->setSeoContent($seo_meta->getSeoContent());
                $seo_meta->setStep(SeoMetaData::STEP_PAGINATE);

            }
            $view = Response::view("frontend.templates.{$page->page_template->folder}.index", $pageHelper->getViewData());
            if (isset($pageHelper->noCache) && $pageHelper->noCache) {
                $view->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            }
            return $view;
        }

        public function catalogMore(Request $request, $alias, $filters = '')
        {
            $pageData   = app(PageData::class);
            $pageHelper = new PageHelper($pageData->getPage());
            $data       = $pageHelper->category($request, $filters);
            $html       = '';
            foreach ($data['products'] as $product) {
                $html .= view('frontend.templates.category.include.product_item', ['product' => $product])->render();
            }
            return response()->json(['html' => $html, 'showMoreAvailable' => $data['showMoreAvailable']]);
        }

        public function pageMore(Request $request, $alias, $filters = '')
        {
            $html       = '';
            $page       = app(PageData::class)->getPage();
            $pageHelper = new PageHelper($page);
            $data       = $pageHelper->callAction($request, $filters);
            if($pageHelper->getViewModels()->isNotEmpty()) {
                $html = view("frontend.templates.{$pageHelper->getAction()}.include.items", $data)->render();
            }
            return response()->json(['html' => $html, 'showMoreAvailable' => $data['showMoreAvailable']]);
        }

        public function getFilterBlock(Request $request, $alias, $filters = '')
        {
            $page          = app(PageData::class)->getPage();
            $pageHelper    = new PageHelper($page);
            $data          = $pageHelper->category($request, $filters);
            $seo_meta      = app(SeoMetaData::class)->getAllData();
            $data['page']  = $page;

	        $html_products   = view('frontend.templates.category.include.product_items', $data)->render();

            $html_filters      = view('frontend.templates.category.include.filters', $data)->render();
            $showMoreAvailable = $data['showMoreAvailable'];

            return response()->json(compact('html_products', 'html_filters', 'showMoreAvailable', 'seo_meta'));
        }
    }
