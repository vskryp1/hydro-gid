<?php

namespace App\Helpers;

use App\Enums\DeliveryType;
use App\Enums\PageAlias;
use App\Models\Client\Client;
use App\Models\Faq\Faq;
use App\Models\Filters\Filter;
use App\Models\Order\Delivery;
use App\Models\Order\Order;
use App\Models\Page\Page;
use App\Models\Product\Product;
use App\Models\Reviews\Review;
use App\Models\Seo\Sitemap;
use App\Models\Sliders\Slider;
use App\Models\Stock\Stock;
use App\Singletons\PageData;
use App\Singletons\SeoMetaData;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use LaravelLocalization;
use Setting;

class PageHelper
{
    protected $page;

    protected $action;

    /**
     * @var bool
     */
    protected $showMoreAvailable;

    protected $viewModels;

    protected $viewData = [];

    protected $redirect;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function callAction(Request $request, string $filters): array
    {
        $folder = stristr($this->page->page_template->folder, '.', true)
            ? stristr($this->page->page_template->folder, '.', true)
            : $this->page->page_template->folder;

        if (
            $this->page
            && $this->page->only_auth
            && !auth('web')->check()
        ) {
            $this->redirect = back(302)->with('warning', __('frontend/content/index.need_auth_to_view_page'));
        } elseif (method_exists($this, $folder)) {
            $this->action = $folder;
            $this->{$this->action}($request, $filters);
        }

        return $this->viewData;
    }

    public function getRedirect(): RedirectResponse
    {
        return $this->redirect;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function hasRedirect(): bool
    {
        return !empty($this->redirect);
    }

    public function getViewModels(): Arrayable
    {
        return $this->viewModels ?? new Collection();
    }

    public function setViewModels(Arrayable $viewModels): void
    {
        $this->viewModels = $viewModels;
    }

    public function getViewData(): array
    {
        $this->putViewData('additional_fields', app(PageData::class)->getAdditionalFields());
        $this->putViewData('page', $this->page);

        return $this->viewData;
    }

    public function putViewData($key, $value)
    {
        if (!isset($this->viewData[$key])) {
            $this->viewData[$key] = $value;
        }
    }

    public function setViewData(array $viewData): void
    {
        $this->viewData = $viewData;
    }

    protected function basket(): array
    {
        $current_delivery = ShopHelper::current_delivery();
        $currency = ShopHelper::current_currency();
        $cartItems = CartHelper::content();

        $this->viewData = compact(
            'current_delivery',
            'currency',
            'cartItems'
        );

        return $this->viewData;
    }

    public function catalog(): array
    {
        $products = Product::onlyActive()
            ->with([
                'currency',
                'product_status.translations',
                'images.translations',
                'pages.translations',
                'reviews',
            ])
            ->paginate();

        $this->viewData = compact('products');

        return $this->viewData;
    }

    public function category(Request $request, string $requestFilters): array
    {
        $categories = CategoryHelper::getPageCategories($this->page);
        $products = ProductHelper::prepareActiveProductsWithFilters()
            ->onlyActive()
            ->whereHas(
                'pages',
                function ($pages) use ($categories) {
                    return $pages->whereIn('page_id', $categories);
                }
            )
            ->whereRaw('products.id = products.parent_id');


        $filterHelper = new FilterHelper($products, $request->offset);
        $filterHelper->setFiltersByProducts();
        $filterHelper->processingFilters($requestFilters);
        $filterHelper->setFiltersByProducts();

        $this->viewModels = $filterHelper->getFilters();
        $this->viewData = $filterHelper->getViewData();

        $this->setSeoMetaFilters($filterHelper, $requestFilters);

        $this->putViewData('recently_viewed_products', ProductHelper::getRecentlyViewed());

        return $this->viewData;
    }

    protected function setSeoMetaFilters($seo_filters, $requestFilters)
    {
        $seo_meta = app(SeoMetaData::class);
        if ($seo_meta->isNotStep(SeoMetaData::STEP_MODULE)) {
            $filters = collect();
            $filter_names = collect();
            $filter_blocks = collect();
            $seo_filters->getFilters()->map(function ($item) use (&$filters, &$filter_blocks, &$filter_names, $seo_filters) {
                $checked_filter = $item->filter_values->where('checked', true);
                if ($item->filter_type->file != Filter::SLIDER && $checked_filter->isNotEmpty()) {
                    $filters = $filters->push($item);
                    $filter_names = $filter_names->merge($checked_filter->pluck('name'));
                    $filter_blocks = $filter_blocks->merge($item->name);
                }
            });
            if ($filters->isNotEmpty()) {
                $seo_meta->setSeoTitle($filters->first()->seo_title
                    ?? $seo_meta->getSeoInfo('title', 'filter',
                        [
                            'name' => $this->page->name,
                            'filter' => $filter_names->implode(', '),
                            'filter_block' => $filter_blocks->implode(', ')
                        ]
                    )
                );
                $seo_meta->setSeoDescription($filters->first()->seo_description
                    ?? $seo_meta->getSeoInfo('description', 'filter',
                        [
                            'name' => $this->page->name,
                            'filter' => $filter_names->implode(', '),
                            'filter_block' => $filter_blocks->implode(', ')
                        ]
                    )
                );
                $seo_meta->setSeoH1($seo_meta->getSeoInfo('h1', 'filter', ['name' => $this->page->name, 'filter' => $filter_names->implode(', ')]));
                $seo_meta->setSeoKeywords($filters->first()->seo_keywords
                    ?? $seo_meta->getSeoInfo('keywords', 'filter', ['name' => $this->page->name, 'filter' => $filters->implode(', ')]));
                $filters->count() <= 1
                    ? $seo_meta->setSeoRobots($filters->first()->seo_robots ?? '')
                    : $seo_meta->setSeoRobots('noindex,nofollow');
                $seo_meta->setSeoCanonical($filters->first()->seo_canonical ?? $this->page->alias . '/' . $requestFilters);
                $seo_meta->setSeoContent($filters->first()->seo_content ?? '');
            } else {
                empty($requestFilters) ?: $seo_meta->setSeoCanonical($this->page->alias);
            }
        }
    }

    protected function blog(Request $request, string $requestFilters): array
    {
        $this->viewData['categories'] = !$this->page->parent_page_id
            ? $this->page->children()->get()
            : Page::find($this->page->parent_page_id)->children()->get();

        if ($request->has('category') && $request->category) {
            $this->viewData['current_category'] = Page::find($request->category);
        } else {
            $this->viewData['current_category'] = isset($this->page->parent_page_id)
                ? Page::find($this->page->id)
                : $this->viewData['categories'];
        }

        if (is_countable($this->viewData['current_category'])) {
            $cat = collect();
            $this->viewData['current_category']->map(function ($item, $key) use (&$cat) {
                $cat = $cat->merge($item->children_active()->get());
            });
            $items = $cat->sortByDesc('created_at')->slice($request->offset);
            $this->showMoreAvailable = count($items) > Setting::get('count-article');
            $this->viewModels = $items->take(Setting::get('count-article'));
        } else {
            $this->getItems(
                $this->viewData['current_category']->children(),
                $request->offset ?? 0,
                Setting::get('count-article')
            );
        }

        $this->viewData['articles'] = $this->viewModels;
        $this->viewData['categories'] = $this->viewData['categories']->pluck('name', 'id');
        $this->viewData['categories']->prepend(__('frontend.all_category_blog'));
        $this->viewData['showMoreAvailable'] = $this->showMoreAvailable;

        return $this->viewData;
    }

    protected function blog_one(): array
    {
        $this->viewData['articles'] = Page::where('parent_page_id', $this->page->parent_page_id)
            ->latest()
            ->take(config('app.limits.frontend.last_articles'))
            ->get();

        return $this->viewData;
    }

    protected function search(Request $request, string $filters): array
    {
        $search = trim($request->input('search'));
        $offset = trim($request->input('offset')) ?? 0;

        if ($request->input('category')) {
            $filters = 'category=' . implode($request->input('category'), ',');
        }

        if (mb_strlen($search) < 3) {
            $this->redirect = redirect(url()->previous() != $request->fullUrl()
                ? url()->previous()
                : url('/'), 302)->with('info', __('frontend.search_length_error'));
        } else {
            $products = ProductHelper::prepareActiveProductsWithFilters()
                ->where(function ($query) use ($search) {
                    $searchItems = explode(' ', $search);
                    $i = 1;
                    foreach ($searchItems as $searchItem) {
                        if($i == 1){
                            $query->WhereTranslationLike('name', '%' . trim($searchItem) . '%');
                            $query->orWhereTranslationLike('description', '%' . trim($searchItem) . '%');
                        }else{
                            $query->orWhereTranslationLike('name', '%' . trim($searchItem) . '%');
                            $query->orWhereTranslationLike('description', '%' . trim($searchItem) . '%');
                        }
                        $i++;
                    }
                    $query->orWhere('sku', $search);
                });
            $products_by_categories = isset($products) ? $products->get()->getItemsByMainCategories() : [];
            $filterHelper = new FilterHelper($products, $offset);
            $filterHelper->processingFilters($filters);
            $filterHelper->setFiltersByProducts();
            $this->viewData = $filterHelper->getViewData();
            $this->viewData['articles'] = Page::whereHas('parent.parent', function ($query) {
                $query->whereAlias(PageAlias::PAGE_BLOG);
            })->whereTranslationLike('name', '%' . $search . '%')
                ->get();
            $this->getItems(
                $products,
                $request->offset ?? 0,
                config('app.limits.frontend.products')
            );
        }
        $this->viewData['search'] = $search;
        $this->viewData['products_count'] = isset($products) ? $products->count() : 0;
        $this->viewData['products_by_categories'] = isset($products_by_categories) ? $products_by_categories : 0;

        return $this->viewData;
    }

    protected function stock(Request $request, string $filters): array
    {
        $query = Stock::onlyActive()->goinOn();
        $this->getItems($query, $request->offset ?? 0, config('app.limits.frontend.stock'));

        return $this->viewData = [
            'showMoreAvailable' => $this->showMoreAvailable,
            'stocks' => $this->viewModels,
        ];
    }

    protected function sitemap(): array
    {
        $pages = Page::onlyActive()
            ->where('use_sitemap', 1)
            ->orderBy('position')
            ->get();
        $this->viewData = [
            'page_list' => $this->build_tree($pages, null),
        ];

        return $this->viewData;
    }

    protected function build_tree($pages, $parent_id)
    {
        $currentPages = $pages->where('parent_page_id', $parent_id);
        $tree = '';
        if ($currentPages->count()) {
            $tree = '<ul>';
            foreach ($currentPages as $page) {
                $tree .= '<li>' . "<a href=\"{$page->alias}\">" . $page->name . "</a>";
                $tree .= $this->build_tree($pages, $page->id);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        }

        return $tree;
    }

    protected function account(): array
    {
        $user = Client::query()
            ->with([
                'addresses',
                'current_orders' => function ($query) {
                    return $query->with(['products', 'products.images', 'order_status'])->orderBy('created_at', 'desc');
                },
                'history_orders' => function ($query) {
                    return $query->with(['products', 'products.images', 'order_status'])->orderBy('created_at', 'desc');
                },
            ])
            ->findOrFail(auth('web')->id());

        $this->viewData['data'] = [
            'user' => $user,
            'addresses' => $user->addresses,
            'wishlist' => $user->wishlist,
            'waitinglist' => $user->waitinglist,
            'reviews' => $user->reviews->sortByDesc('created_at'),
            'courier_delivery' => Delivery::whereType(DeliveryType::COURIER_NP)->first(),
            'current_orders' => $user->current_orders,
            'history_orders' => $user->history_orders,
        ];

        return $this->viewData;
    }

    protected function review(): array
    {
        $reviews = Review::onlyActive()
            ->onlyAboutPage()
            ->orderByDesc('created_at')
            ->get()
            ->take(10);

        $this->viewData['data'] = ['reviews' => $reviews];

        return $this->viewData;
    }

    protected function thankyou(): array
    {
        // TODO need to undr what is that
        if (session('order_id') == '') {
            $this->redirect = redirect(url(config('cart.empty_redirect')), 302);
//                    ->with('warning', __('frontend.session_is_out'));
        } else {
            $this->viewData = [
                'order' => Order::with(['payment', 'delivery'])
                    ->whereUniqueId(session('order_id'))
                    ->first(),
            ];
        }

        return $this->viewData;
    }

    protected function checkout_step1(): array
    {
        if (Cart::instance('default')->count() <= 0) {
            $this->redirect = redirect(url(config('cart.empty_redirect')), 302)
                ->with('warning', __('frontend.empty_checkout_message'));
            $this->noCache = true;
        } elseif (auth('web')->check()) {
            $this->redirect = redirect()->route('frontend.page', PageAlias::PAGE_CHECKOUT_STEP_2, 302);
            $this->noCache = true;
        } else {
            $current_delivery = ShopHelper::current_delivery();
            $currency = ShopHelper::current_currency();
            $cartItems = CartHelper::content();

            $this->viewData = compact(
                'cartItems', 'current_delivery', 'currency'
            );
            $this->noCache = true;
        }

        return $this->viewData;
    }

    protected function checkout_step2(): array
    {
        if (Cart::count() <= 0) {
            $this->redirect = redirect(url(config('cart.empty_redirect')), 302)
                ->with('warning', __('frontend.empty_checkout_message'));
            $this->noCache = true;
        } else {
            $current_delivery = ShopHelper::current_delivery();
            $current_payment = ShopHelper::current_payment();
            $currency = ShopHelper::current_currency();
            $payments = ShopHelper::getPayments();
            $deliveries = ShopHelper::getDeliveries();
            $cartItems = CartHelper::content();

            $this->viewData = compact(
                'payments', 'deliveries', 'cartItems', 'current_delivery',
                'currency', 'current_payment'
            );
        }

        return $this->viewData;
    }

    public function faq(Request $request, string $filters): array
    {
        $faqsQuery = Faq::onlyActive()->byPosition();
        $this->getItems($faqsQuery, $request->offset ?? 0, config('app.limits.frontend.faq'));

        return $this->viewData = [
            'showMoreAvailable' => $this->showMoreAvailable,
            'faqs' => $this->viewModels,
        ];
    }

    public function compare_cart(Request $request, string $filters): array
    {
        $cart = Cart::instance('comparelist');
        if (auth('web')->check()) {
            $cart->restore('comparelist.' . auth('web')->id(), false);
        }
        $comparelist = $cart->content()->reverse()->groupBy(function ($item) {
            return $item->model->mainCategory->id;
        });
        return $this->viewData = compact('comparelist');
    }

    public function compare(Request $request, string $filters): array
    {
        $cart = Cart::instance('comparelist');
        if (auth('web')->check()) {
            $cart->restore('comparelist.' . auth('web')->id(), false);
        }
        $comparelist = $cart->content()->reverse();
        $products = Product::whereIn('id', $comparelist->pluck('id'))
            ->with(['filter_values.translations'])
            ->selectRaw('products.*, page_product.page_id as categoryId')
            ->join('page_product', 'products.id', '=', 'page_product.product_id')
            ->where('page_product.page_id', $request->category_id)
            ->where('page_product.is_main', true)
            ->get();

        $filterHelper = new FilterHelper();
        $filterHelper->getFiltersByProducts($products->pluck('id'));
        $filters = $filterHelper->getFilters();

        //404 if empty compareList
        abort_if($comparelist->isEmpty() || $products->isEmpty(), 404);

        return $this->viewData = compact('products', 'filters', 'comparelist');
    }

    public function main(Request $request, string $filters): array
    {
        $stocks = Stock::goinOn()
            ->onlyActive()
            ->with(['page' => function ($q) {
                $q->byPosition();
                $q->where('active', true);
            }])
            ->onlyMain()
            ->byPosition()
            ->limit(config('app.limits.frontend.stock_main'))
            ->get();

        $slider = Slider::onlyActive()
            ->with(['slider_items' => function ($q) {
                $q->byPosition();
                $q->where('active', true);
            }])
            ->where('alias', Slider::MAIN_PAGE_SLIDER)
            ->first();

        $advantages = Page::onlyActive()
            ->with('additional_field_values')
            ->whereIn('alias', ['quickly', 'profitable', 'reliably', 'professionally'])
            ->get();

        return $this->viewData = compact('stocks', 'slider', 'advantages');
    }

    public function about(Request $request, string $filters): array
    {
        $slider_about = Slider::onlyActiveWithItems()->where('alias', Slider::ABOUT_US_SLIDER)->first();
        $slider_gallery = Slider::onlyActiveWithItems()->where('alias', Slider::ABOUT_US_GALLERY_SLIDER)->first();
        $advantages = Page::onlyActive()->with('additional_field_values')->whereIn('alias', ['quickly', 'profitable', 'reliably', 'professionally'])->get();

        return $this->viewData = compact('slider_about', 'slider_gallery', 'advantages');
    }

    public function getItems($builder, $offset, $limit): Collection
    {
        $items = $builder->orderByDesc('created_at')
            ->offset($offset)
            ->limit($limit + 1)
            ->get();

        $this->showMoreAvailable = count($items) > $limit;
        return $this->viewModels = $items->take($limit);
    }

    public static function getBreadcrumbsPage($page)
    {
        return Cache::tags('pages')
            ->remember(
                'breadcrumbs.' . '.' . app()->getLocale() . $page->alias,
                config('app.cache_minutes'),
                function () use ($page) {
                    $breadcrumbs = self::getCrumb($page, []);
                    $breadcrumbs[] = ['name' => __('frontend.home'), 'url' => LaravelLocalization::localizeUrl(url('/'))];

                    return array_reverse($breadcrumbs);
                }
            );
    }

    public static function getCrumb($page, $breadcrumbs = [])
    {
        $breadcrumbs[] = [
            'name' => $page->name,
            'url' => LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), $page->alias),
        ];

        if ($page->parent) {
            $breadcrumbs = self::getCrumb($page->parent, $breadcrumbs);
        }

        return $breadcrumbs;
    }

    public static function getLatestPosts($alias = 'articles', $limit = 4)
    {
        return Cache::tags('pages')
            ->remember(
                'mainArticles.' . $alias . '.' . app()->getLocale(),
                config('app.cache_minutes'),
                function () use ($alias, $limit) {
                    $articles = Page::whereAlias($alias)->first();

                    if ($articles) {
                        return $articles->children_active_posts()
                            ->latest()
                            ->limit($limit)
                            ->get()
                            ->each(
                                function ($item) {
                                    foreach ($item->additional_field_values as $additional_field_value) {
                                        return $item->{$additional_field_value->additional_field->key} = $additional_field_value->value;
                                    }
                                }
                            );
                    }

                    return [];
                }
            );
    }

    public function certificates(Request $request, string $filters): array
    {
        $slider = Slider::onlyActiveWithItems()->where('alias', Slider::CERTIFICATE_SLIDER)->first();

        return $this->viewData = compact('slider');
    }

    public function calculator()
    {
        $categories = Page::calculatorCategories();

        return $this->viewData = compact('categories');
    }

    public static function isActivePage($alias)
    {
        return Cache::tags('pages')
            ->remember(
                'activepage' . '.' . app()->getLocale() . $alias,
                config('app.cache_minutes'),
                function () use ($alias) {
                    return Page::where('alias', $alias)->first()->active ?? false;
                }
            );
    }
}
