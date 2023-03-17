<?php

    namespace App\Helpers;

    use App\Models\Product\Product;
    use App\Models\Product\ProductStatus;
    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Cache;
    use Session;

    class ProductHelper
    {
        public static function prepareActiveProducts()
        {
            return Product::onlyActive()
                          ->with([
                              'images.translations',
                              'pages.translations',
                              'filter_values.translations',
                              'product_status.translations',
                              'group.option_filters.translations',
                          ]);
        }

        public static function prepareActiveProductsWithFilters()
        {
            return Product::onlyActive()
                          ->with([
                              'images.translations',
                              'filter_values.translations',
                              'filter_values.translations',
                              'product_status.translations',
                              'filter_values.filter.translations',
                              'filter_values'        => function($query) {
                                  $query->orderBy('position')
                                        ->whereHas(
                                            'filter',
                                            function($query) {
                                                $query->where('is_technical', false);
                                            }
                                        );
                              },
                              'filter_values.filter' => function($query) {
                                  $query->orderBy('position');
                              },
	                          'pages'
                          ]);
        }

        public static function getProductParams($product)
        {

            $products = [];
            $group    = Cache::tags(['products', 'filters'])
                             ->remember(
                                 'products.group.' . $product->id,
                                 config('app.cache_minutes'),
                                 function() use ($product) {
                                     return $product->group;
                                 }
                             );

            foreach ($group as $product) {
                $option_filters = Cache::tags(['products', 'filters'])
                                       ->remember(
                                           'products.option_filters.' . $product->id,
                                           config('app.cache_minutes'),
                                           function() use ($product) {
                                               return $product->option_filters;
                                           }
                                       );

                foreach ($option_filters as $value) {
                    $products[] = ['product' => $product, 'value' => $value];
                }
            }
            ksort($products);
            return $products;
        }

        public static function setRecentlyViewed($product)
        {
            $products = Session::get('products', []);

            if (!$products) {
                array_push($products, $product);
            } else {
                $alreadyAdded = collect($products)->pluck('id')->contains($product->id);
                if (!$alreadyAdded) {
                    array_push($products, $product);
                }
            }

            Session::put('products', $products);
        }

        public static function getRecentlyViewed()
        {
            return Session::get('products', []);
        }

        public static function getWishlistRowId(Product $product)
        {
            if ($user = Auth::guard('web')->user()) {
                foreach ($user->wishlist as $item) {
                    if ($item->id === $product->id) {
                        return $item->rowId;
                    }

                    continue;
                }
            }

            return null;
        }

        public static function checkReviewTypeIsProduct($type)
        {
            return $type === get_class(new Product);
        }

        public static function getProductFromReviews($sku)
        {
            return Product::where('sku', $sku)->first()->alias;
        }

        public static function getProductStatus($alias)
        {
            return Cache::tags(['product_statuses'])
                 ->remember(
                     'product_statuses_' . App::getLocale() . $alias,
                     config('app.cache_minutes'),
                     function () use ($alias) {
                         return ProductStatus::onlyActive()
                                    ->alias($alias)
                                    ->first();
                     }
                 );
        }

        public static function getFilterName($packages)
        {
            $filterName = Arr::first($packages)['value']->filter->name;
            return $filterName ?? null;
        }
    }
