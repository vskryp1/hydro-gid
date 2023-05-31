<?php

    namespace App\Http\Controllers\Frontend;

    use App\Helpers\PageHelper;
    use App\Helpers\ProductHelper;
    use App\Helpers\ShopHelper;
    use App\Http\Requests\Frontend\Products\SearchRequest;
    use App\Models\Filters\Filter;
    use App\Models\Product\Product;
    use App\Models\Reviews\Review;
    use App\Singletons\BreadcrumbsData;
    use App\Singletons\OgMetaData;
    use App\Singletons\SchemaOrgData;
    use App\Singletons\SeoMetaData;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Intervention\Image\Facades\Image;
    use Spatie\SchemaOrg\Schema;
    use LaravelLocalization;
    use PDF;

    class ProductController extends Controller
    {
        public function page(Request $request)
        {
            $product = Product::onlyActive()
                ->with([
                    'currency',
                    'product_status.translations',
                    'images.translations',
                    'pages.translations',
                ])
                ->whereAlias($request->alias)
                ->firstOrFail();

            $image = $product->cover->getUrl('prod_xl');
            $intro = strip_tags($product->introtext);

            $og_meta = app(OgMetaData::class);
            $og_meta->setOgTitle($product->name);
            $og_meta->setOgDescription($intro);
            $og_meta->setOgImg($image);
	        $og_meta->setOgLocale(LaravelLocalization::getCurrentLocaleRegional());
	        $og_meta->setOgUrl($request->url());

            $breadcrumbs = app(BreadcrumbsData::class);
            $breadcrumbs->setBreadcrumbs(PageHelper::getBreadcrumbsPage($product->main_category));
            $breadcrumbs->addBreadcrumb(['name' => $product->name, 'url' => $product->alias]);

            $seo_meta = app(SeoMetaData::class);
            if ($seo_meta->isNotStep(SeoMetaData::STEP_MODULE)) {
                //2 step set meta tags of 4
                $seo_meta->setSeoTitle(__('frontend/product/index.seo_title', ['name' => $product->name, 'sku' => $product->sku]));
                $seo_meta->setSeoDescription($product->seo_description ?? __('frontend/product/index.seo_description', ['name' => $product->name, 'sku' => $product->sku]));
                $seo_meta->setSeoKeywords($product->seo_keywords ?? __('frontend/product/index.seo_keywords', ['name' => $product->name]));
                $seo_meta->setSeoRobots($product->seo_robots);
                $seo_meta->setSeoCanonical($product->seo_canonical ?? $request->url());
                $seo_meta->setSeoContent($product->seo_content);
                $seo_meta->setStep(SeoMetaData::STEP_PRODUCT);
            }
            // related products
            $relatedProducts = $product->productRelations()
                ->with(['pages', 'currency'])
                ->randomNotSelfLimited($product, config('app.limits.frontend.related'))
                ->get();
            // similar products
            $similarProducts = $product->similarProducts()
                ->with(['pages', 'currency'])
                ->randomNotSelfLimited($product, config('app.limits.frontend.similar'))
                ->get();

            $filters = Filter::byFilterValuesIds($product->filter_values->pluck('id'))->get();

            $baseFilters      = $filters->where('is_technical', false);
            $technicalFilters = $filters->where('is_technical', true);

            $reviews = Review::onlyActive()
                ->onlyAboutSpecificProduct($product)
                ->get()
                ->sortByDesc('created_at')
                ->take(10);

            $packages   = ProductHelper::getProductParams($product);
            $warranties = $product->warranties()->activeByPosition()->get();
            if($product->allow_default_warranty){
                $product->pages->map(
                    function ($item) use ($warranties) {
                        if($item->warranty){
                            $warranties->prepend($item->warranty);
                        }
                    }
                );
            }
            ProductHelper::setRecentlyViewed($product);

            $payments           = ShopHelper::getPayments();
            $deliveries         = ShopHelper::getDeliveries();

            return view('frontend.templates.product.index',
                compact(
                    'product',
                    'baseFilters',
                    'technicalFilters',
                    'relatedProducts',
                    'similarProducts',
                    'reviews',
                    'packages',
                    'warranties',
                    'payments',
                    'deliveries'
                )
            );
        }

        public function generatePdf(Product $product)
        {
            $baseFilters = Filter::byFilterValuesIds($product->filter_values->pluck('id'))
                ->where('is_technical', false)
                ->get();
            $image  = Image::make($product->cover->image_path)->encode('data-url')->encoded;
            $pdf    = PDF::loadView('frontend.templates.product.pdf', compact('product', 'baseFilters', 'image'));

            return $pdf->stream($product->name . '.pdf');
        }

        public function search(SearchRequest $request)
        {
            $html     = '';
            $products = ProductHelper::prepareActiveProducts()
                ->whereTranslationLike('name', '%' . $request->input('q') . '%')
                ->take(10)
                ->get();

            foreach ($products as $product) {
                $html .= view('frontend.templates.search.product-item', compact('product'));
            }

            return $html;
        }

        public function getProductCard($product)
        {
            $product = Product::with(['group.option_filters.translations'])->findOrFail($product);

            return view('frontend.templates.category.product-item', compact('product'));
        }
    }
