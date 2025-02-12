<?php

    namespace App\Helpers;

    use App\Models\Filters\Filter;
    use App\Singletons\SeoMetaData;
    use Cache;
    use Illuminate\Pagination\Paginator;

    class FilterHelper
    {
        const DEFAULT_LIMIT = 1;

        protected $products = null;

        protected $offset = null;

        protected $filters = [];

        protected $activeFilters = [];

        protected $filterPrices = [];

        protected $defaultFilterPrices = [];

        protected $sort;

        protected $limit;

        protected $defaultLimit;

        protected $filtersCount;

        protected $showMoreAvailable;

        /**
         * @var string
         */
        protected $whereFiltersRaw;

        protected $filterHelper;

        protected $filterAvailability = [];

        protected $filterRanges = [];

        protected $defaultFilterRanges = [];

        public function __construct($products = null, $offset = null)
        {
            $this->products = $products;
            $this->offset   = $offset;
        }

        public function getFilterCategory($categories, $cacheKey)
        {
            return $this->filters = Cache::remember('page_filters.' . $cacheKey,
                config('app.cache_minutes'),
                function() use ($categories) {
                    return Filter::filtersSort()//                        ->with([
                                                //                            'translations',
                                                //                            'filter_type',
                                                //                            'filter_values' => function ($filter_values) {
                                                //                                return $filter_values->onlyActive()
                                                //                                    ->with('translations')
                                                ////                            ->withCount([
                                                ////                            'products' => function ($products) use ($categories) {
                                                ////                                return $products->whereHas('pages', function ($pages) use ($categories) {
                                                ////                                    return $pages->whereIn('page_id', $categories);
                                                ////                                })->onlyActive();
                                                ////                            },
                                                ////                        ])
                                                //                                    ->filterValuesSort(['position' => 'asc']);
                                                //                            },
                                                //                        ])
                                 ->select('filters.*')//                        ->join('filter_values', 'filter_values.filter_id', '=', 'filters.id')
//                        ->join('filter_value_product', 'filter_value_product.filter_value_id', '=', 'filter_values.id')
                                 ->join('filter_page',
                        'filter_page.filter_id',
                        '=',
                        'filters.id')//                        ->whereIn('filter_value_product.product_id', $products->pluck('id'))
                                 ->whereIn('filter_page.page_id', $categories)
                                 ->where('filters.active', true)
                                 ->groupBy('filters.id')
                                 ->get();
                });
        }

        public function getFiltersByProducts($productIds)
        {
            return $this->filters = Filter::filtersSort()
                                          ->select('filters.*')
                                          ->with([
                                              'translations',
                                              'filter_type',
                                              'filter_values' => function($filter_values) use (
                                                  $productIds
                                              ) {
                                                  return $filter_values->onlyActive()
                                                                       ->with('translations')
                                                                       ->whereHas('products',
                                                                           function($q) use (
                                                                               $productIds
                                                                           ) {
                                                                               $q->whereIn('id',
                                                                                   $productIds);
                                                                           })//                            ->withCount([
                                                      //                            'products' => function ($products) use ($categories) {
                                                      //                                return $products->whereHas('pages', function ($pages) use ($categories) {
                                                      //                                    return $pages->whereIn('page_id', $categories);
                                                      //                                })->onlyActive();
                                                      //                            },
                                                      //                        ])
                                                                       ->filterValuesSort(['position' => 'asc']);
                                              },
                                          ])
                                          ->where('filters.active', true)
                                          ->groupBy('filters.id')
                                          ->get();
        }

        public function checkPrices($values)
        {
            $current_currency          = ShopHelper::current_currency();
            $default_currency          = ShopHelper::default_currency();
            $this->filterPrices['min'] = $values[0];
            $this->filterPrices['max'] = $values[1];
            $this->products->whereBetween(
                'price',
                [
                    ShopHelper::price_convert($values[0], $current_currency, $default_currency),
                    ShopHelper::price_convert($values[1], $current_currency, $default_currency)
                ]
            );
            $this->filtersCount++;
        }

        public function checkCategories($values)
        {
	        $this->products->whereHas('pages', function($query) use ($values) {
	        	$query->whereIn('id', $values);
	        	$query->where('is_main', 1);
	        });
            $this->filtersCount++;
        }

        public function checkAvailability($values)
        {
            $this->products->whereIn('availability', $values);
            $this->filterAvailability = $values;
            $this->filtersCount++;
        }

	    public function sortProductsByAvailability(){
		    $this->products->orderByRaw("availability <> 0 DESC");
	    }

        public function setSorts()
        {
            switch ($this->sort) {
            case 'price_asc':
                $this->products->orderBy('price', 'asc');

                break;
            case 'price_desc':
                $this->products->orderBy('price', 'desc');

                break;
            case 'popular':
                // @TODO order by popular (rating)
                break;
            default:
                $this->products->orderBy('position');
            }
        }

        public function setLimits()
        {
            if ($this->offset) {
	            $this->products->offset($this->offset);
            }

	        $this->products->limit($this->getLimit() + self::DEFAULT_LIMIT);
        }

	    public function setFiltersByProducts()
	    {
		    $productIds = $this->products->pluck('id');
			$this->getFiltersByProducts($productIds);
	    }

        public function checkFilters($whereFiltersRaw)
        {
            $whereFilters          = [];
            $whereOrFilters        = [];
            $whereBetween          = [];
            $this->whereFiltersRaw = $whereFiltersRaw;
            $this->activeFilters   = $this->filters->whereIn('alias', array_keys($whereFiltersRaw));
            $this->activeFilters->map(function($filter) use (
                $whereFiltersRaw,
                &$whereFilters,
                &$whereOrFilters,
                &$whereBetween
            ) {

                switch ($filter->filter_type->file) {
                case 'slider':
                    $whereBetween[$filter->alias] = $whereFiltersRaw[$filter->alias];
                    $this->filterRanges[$filter->alias]['min'] = $whereFiltersRaw[$filter->alias][0];

                    if (count($whereFiltersRaw[$filter->alias]) > 1) {
                        $this->filterRanges[$filter->alias]['max'] = $whereFiltersRaw[$filter->alias][1];
                    } else {
                        $this->filterRanges[$filter->alias]['max'] = $filter->filter_values->max('alias');
                        $whereBetween[$filter->alias][] = $filter->filter_values->max('alias');
                    }

                    break;
                case 'radiobutton':
                    if (!isset($whereFilters[$filter->alias])) {
                        $whereFilters[$filter->alias] = [];
                    }

                    $whereFilters[$filter->alias] = $whereFiltersRaw[$filter->alias];

                    break;
                default:
                    if (!isset($whereOrFilters[$filter->alias])) {
                        $whereOrFilters[$filter->alias] = [];
                    }

                    $whereOrFilters[$filter->alias] = $whereFiltersRaw[$filter->alias];
                }
            });

            $this->selectProductsByFilterValues($whereBetween, $whereFilters, $whereOrFilters);
        }

        public function selectProductsByFilterValues($whereBetween, $whereFilters, $whereOrFilters)
        {
            if (count($whereBetween) > 0) {
                $this->products->where(function($products) use ($whereBetween) {
                    foreach ($whereBetween as $filterKey => $whereFilter) {
                        $products = $products->whereHas('filter_values',
                            function($filter_values) use ($filterKey, $whereFilter) {
                                return $filter_values->whereBetween('alias', array_map('intval', $whereFilter))->whereHas('filter',
                                    function($filter) use ($filterKey) {
                                        return $filter->onlyActive()->whereAlias($filterKey);
                                    });
                            });
                    }
                });
            }

            if (count($whereFilters) > 0) {
                $this->products->where(function($products) use ($whereFilters) {
                    foreach ($whereFilters as $filter_key => $where_filter) {
                        foreach ($where_filter as $value) {
                            $products = $products->orWhereHas('filter_values',
                                function($filter_values) use ($filter_key, $value) {
                                    return $filter_values->where('alias', $value)->whereHas('filter',
                                        function($filter) use ($filter_key) {
                                            return $filter->whereAlias($filter_key);
                                        });
                                });
                        }
                    }
                });
            }

            if (count($whereOrFilters) > 0) {
                $this->products->where(function($products) use ($whereOrFilters) {
                    foreach ($whereOrFilters as $filterAlias => $filterValueAliases) {
                        $products = $products->whereHas('filter_values',
                            function($filter_values) use ($filterAlias, $filterValueAliases) {
                                return $filter_values->whereIn('alias', $filterValueAliases)->whereHas('filter',
                                    function($filter) use ($filterAlias) {
                                        return $filter->whereAlias($filterAlias);
                                    });
                            });
                    }
                });
            }
        }

        public function parseRequestFilters($requestFiltersRaw)
        {
            $activeFilters  = [];
            $requestFilters = explode(config('app.separators.filters.filter_filter'), $requestFiltersRaw);

            foreach ($requestFilters as $filter) {
                $filter                      = explode(config('app.separators.filters.filter_value'), $filter);
                $filterAlias                 = $filter[0];
                $filterValuesAliases         = explode(config('app.separators.filters.value_value'), $filter[1]);
                $activeFilters[$filterAlias] = $filterValuesAliases;
            }

            return $activeFilters;
        }

        public function processingFilters($requestFiltersRaw)
        {
            $this->defaultLimit = ShopHelper::setting('catalog_paginate_limit',
                config('app.limits.frontend.products', 20));
            $this->setDefaultProductPriceRange();
            $this->setDefaultFilterRange();
	        $this->sortProductsByAvailability();
            $closeRobots        = false;
            if ($requestFiltersRaw) {
                $whereFilters      = [];
                $activefiltersData = $this->parseRequestFilters($requestFiltersRaw);
                foreach ($activefiltersData as $filterAlias => $valueAliases) {
                    if ($filterAlias && count($valueAliases) > 0) {
                        switch ($filterAlias) {
                        case Filter::PRICE:
                            $closeRobots = true;
                            $this->checkPrices($valueAliases);
                            break;
                        case Filter::CATEGORY:
	                        $closeRobots = true;
	                        $this->checkCategories($valueAliases);

	                        break;
                        case Filter::SORT:
                            $closeRobots = true;
                            $this->sort  = reset($valueAliases);

                            break;
                        case Filter::LIMIT:
                            $limit = reset($valueAliases);
                            if (in_array($limit, config('app.filters.products_count_on_page'))) {
                                $this->limit = reset($valueAliases);
                            }

                            break;
                        case Filter::AVAILABILITY:
                            $closeRobots = true;
                            $this->checkAvailability($valueAliases);

                            break;
                        default:
                            if (count($valueAliases) >= config('app.filters.count_for_noindex.value')) {
                                $closeRobots = true;
                            }

                            $whereFilters[$filterAlias] = $valueAliases;
                            break;
                        }

                        if (count($whereFilters) >= config('app.filters.count_for_noindex.filter')) {
                            $closeRobots = true;
                        }
                    }
                }
                if($whereFilters){
	                $this->checkFilters($whereFilters);
                }
                $this->setSorts();
            }

            $seo_meta = app(SeoMetaData::class);

            if ($closeRobots && $seo_meta->isNotStep(SeoMetaData::STEP_MODULE)) {
                /** 3 step set meta tags of 4 */
                $seo_meta->setSeoRobots('noindex,nofollow');
                $seo_meta->setStep(SeoMetaData::STEP_FILTER);
            }

            return $this->activeFilters;
        }

        public function getViewData()
        {
            $this->hasMoreProducts();
            $this->filterHelper = $this;

            return get_object_vars($this);
        }
/*
        protected function hasMoreProducts()
        {
            $productIds = $this->products->pluck('id');
            $this->recheckFilters();
            $page = $_GET['page'] ?? 1;
            $this->products = $this->products->orderBy('is_disable_price', 'ASC')->paginate($this->getLimit());
            $this->showMoreAvailable = $page < $this->products->lastPage();
        }
*/

        protected function hasMoreProducts()
        {
            $currentPage = (int)ceil(((int)$this->offset + (int)$this->getLimit()) / (int)$this->getLimit());

            if($currentPage > 1){
                Paginator::currentPageResolver(function () use ($currentPage) {
                    return $currentPage;
                });
            }

            $productIds = $this->products->pluck('id');
            $totalProducts = $this->products->count();
            $this->recheckFilters();
            $page = $_GET['page'] ?? 1;
            $this->products = $this->products->orderBy('is_disable_price', 'ASC')->paginate($this->getLimit());
            $this->showMoreAvailable = $totalProducts > ((int)$this->offset + (int)$this->getLimit());
        }

        public function getLimit()
        {
            return $this->limit ?? $this->defaultLimit;
        }

        /**
         * Return filter ranges (min|max) for slider
         *
         * @return array
         */
        public function setDefaultFilterRange()
        {
            foreach($this->filters as $filter){
                if($filter->filter_type->file == 'slider' && $filter->filter_values->isNotEmpty())
                {
                    $this->defaultFilterRanges[$filter->alias]['min'] = $filter->filter_values->min('alias');
                    $this->defaultFilterRanges[$filter->alias]['max'] = $filter->filter_values->max('alias');
                }
            }
        }

        /**
         * Return filter`s range (min|max) by alias
         *
         * @param  string $alias
         * @param  string $type
         *
         * @return array
         */
        public function getDefaultFilterValue(string $alias, string $type = 'min')
        {
            return $this->defaultFilterRanges[$alias][$type];
        }

        /**
         * Return filter`s current range (min|max) by alias
         *
         * @param  string $alias
         * @param  string $type
         *
         * @return array
         */
        public function getCurrentFilterValue(string $alias, string $type = 'min')
        {
            return isset($this->filterRanges[$alias])
                ? $this->filterRanges[$alias][$type]
                : $this->defaultFilterRanges[$alias][$type];
        }

        /**
         * Return both filter ranges (min|max) by alias
         *
         * @param  string $alias
         *
         * @return array
         */
        public function getFilterRangeForSlider(string $alias)
        {
            return isset($this->filterRanges[$alias])
                ? "[{$this->filterRanges[$alias]['min']} , {$this->filterRanges[$alias]['max']} ]"
                : "[{$this->defaultFilterRanges[$alias]['min']} , {$this->defaultFilterRanges[$alias]['max']} ]";
        }

        public function setDefaultProductPriceRange()
        {
            $current_currency     = ShopHelper::current_currency();
            $default_currency     = ShopHelper::default_currency();
            $this->defaultFilterPrices['min'] = floor(ShopHelper::price_convert($this->products->min('price'),
                $default_currency,
                $current_currency));
            $this->defaultFilterPrices['max'] = ceil(ShopHelper::price_convert($this->products->max('price'),
                $default_currency,
                $current_currency));
            return $this->defaultFilterPrices;
        }

        public function getPriceRangeForSlider()
        {
            return $this->filterPrices
                ? "[{$this->filterPrices['min']} , {$this->filterPrices['max']} ]"
                : "[{$this->defaultFilterPrices['min']} , {$this->defaultFilterPrices['max']} ]";
        }

        public function getDefaultPriceValue(string $type = 'min')
        {
            return $this->defaultFilterPrices[$type];
        }

        public function getCurrentPrice(string $type = 'min')
        {
            return $this->filterPrices
                ? $this->filterPrices[$type]
                : $this->defaultFilterPrices[$type];
        }

        public static function getStartSeparator()
        {
            return config('app.separators.filters.start')
                ? config('app.separators.filters.start') . '/'
                : '';
        }

        public static function getAliasRegExp()
        {
            return '([' . config('app.alias_chars') . ']+)';
        }

        public static function getFiltersRegExp()
        {
            return '(([' .
                config('app.alias_chars') .
                ']+\\' .
                config('app.separators.filters.filter_value') .
                '[' .
                config('app.alias_chars') .
                '\\' .
                config('app.separators.filters.value_value') .
                '\.]+)\\' .
                config('app.separators.filters.filter_filter') .
                '?){1,}';
        }

        /**
         * @return mixed
         */
        public function recheckFilters()
        {
            $this->filters->map(function($filter) {
                $filter->filter_values->setCheckedValues($this->whereFiltersRaw[$filter->alias] ?? []);
                $this->filtersCount += $filter->filter_values->getCheckedValues()->count();
            });
            $this->activeFilters = $this->filters;
        }

        public function getFilters()
        {
            return $this->filters;
        }
    }
