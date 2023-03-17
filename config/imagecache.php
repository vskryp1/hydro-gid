<?php

    return [

        'route' => 'cache',

        'paths' => [
            public_path('assets/frontend/images'),
            storage_path('app/public/products'),
            storage_path('app/public/sliders'),
            storage_path('app/public/pages'),
            storage_path('app/public/stocks'),
        ],

        'templates' => [
            'product'             => App\Filters\Product\Backend\GalleryFilter::class,
            'prod_full'           => App\Filters\Product\Frontend\FullSizeFilter::class,
            'prod_xl'             => App\Filters\Product\Frontend\XLFilter::class,
            'prod_md'             => App\Filters\Product\Frontend\MDFilter::class,
            'prod_sm'             => App\Filters\Product\Frontend\SMFilter::class,
            'prod_xsm'            => App\Filters\Product\Frontend\XSMFilter::class,
            'slider_md'           => App\Filters\Product\Frontend\MDFilter::class,
            'page_md'             => App\Filters\Product\Frontend\MDFilter::class,
            'page_blog'           => App\Filters\Product\Frontend\PageBlogFilter::class,
            'page_blog_one'       => App\Filters\Product\Frontend\PageBlogOneFilter::class,
            'page_blog_product'   => App\Filters\Product\Frontend\PageBlogOneProductFilter::class,
            'prod_cart'           => App\Filters\Product\Frontend\ProdCartFilter::class,
            'cert'                => App\Filters\Product\Frontend\CertificatesFilter::class,
            'service'             => App\Filters\Product\Frontend\ServiceFilter::class,
            'stocks'              => App\Filters\Product\Frontend\StockFilter::class,
            'sliders'             => App\Filters\Product\Frontend\SliderFilter::class,
            'category'            => App\Filters\Product\Frontend\CategoryFilter::class,
            'main_big_category'   => App\Filters\Product\Frontend\MainBigCategoryFilter::class,
            'main_small_category' => App\Filters\Product\Frontend\MainSmallCategoryFilter::class,
        ],

        'lifetime' => 43200,

        'cache_driver' => 'file'

    ];
