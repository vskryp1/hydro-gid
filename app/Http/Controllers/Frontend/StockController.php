<?php

    namespace App\Http\Controllers\Frontend;

    use App\Http\Controllers\Controller;
    use App\Models\Product\Product;
    use App\Models\Stock\Stock;
    use App\Singletons\SeoMetaData;

    /**
     * Class StockController
     *
     * @package App\Http\Controllers\Frontend
     */
    class StockController extends Controller
    {
        /**
         * @param  string $stockId
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
         * @throws \Throwable
         */
        public function details(string $stockId)
        {
            $stock = Stock::with([
                'products.images.translations',
                'products.product_status.translations',
            ])->goinOn()->onlyActive()->findOrFail($stockId);

            $seo_meta = app(SeoMetaData::class);

            if ($seo_meta->isNotStep(SeoMetaData::STEP_MODULE)) {
                $seo_meta->setSeoTitle($stock->seo_title ?? $seo_meta->getSeoInfo('title', 'stock', ['name' => $stock->name]));
                $seo_meta->setSeoDescription($stock->seo_description ?? $seo_meta->getSeoInfo('description', 'stock', ['name' => $stock->name]));
                $seo_meta->setSeoKeywords($stock->seo_keywords ?? '');
                $seo_meta->setSeoCanonical($stock->seo_canonical ?? request()->url());
            }
            $seo_meta->setSeoH1($stock->name);

            return view('frontend.templates.stock-page.index', compact('stock'));
        }
    }
