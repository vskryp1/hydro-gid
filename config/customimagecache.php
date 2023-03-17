<?php

return [
    'types' => [
        'products' =>
            [
                'product'   => App\Filters\Product\Backend\GalleryFilter::class,
                'prod_full' => App\Filters\Product\Frontend\FullSizeFilter::class,
                'prod_xl'   => App\Filters\Product\Frontend\XLFilter::class,
                'prod_md'   => App\Filters\Product\Frontend\MDFilter::class,
                'prod_md_optimize' => App\Filters\Product\Frontend\MDOptimizeFilter::class,
                'prod_sm'   => App\Filters\Product\Frontend\SMFilter::class,
                'prod_xsm'  => App\Filters\Product\Frontend\XSMFilter::class,
                'prod_cart' => App\Filters\Product\Frontend\ProdCartFilter::class,
            ],
        'sliders'  => [
            'slider_md' => App\Filters\Product\Frontend\MDFilter::class,
            'slider_lg' => App\Filters\Product\Frontend\LGFilter::class,
            'slider_sm' => App\Filters\Product\Frontend\SliderSmFilter::class,
            'slider_slim' => App\Filters\Product\Frontend\SliderSlimFilter::class,
            'sliders'   => App\Filters\Product\Frontend\SliderFilter::class,
            'cert'      => App\Filters\Product\Frontend\CertificatesFilter::class,
        ],
        'pages'    => [
            'page_md'             => App\Filters\Product\Frontend\MDFilter::class,
            'page_blog'           => App\Filters\Product\Frontend\PageBlogFilter::class,
            'page_blog_one'       => App\Filters\Product\Frontend\PageBlogOneFilter::class,
            'page_blog_product'   => App\Filters\Product\Frontend\PageBlogOneProductFilter::class,
            'service'             => App\Filters\Product\Frontend\ServiceFilter::class,
            'main_service'        => App\Filters\Product\Frontend\MainServiceFilter::class,
            'category'            => App\Filters\Product\Frontend\CategoryFilter::class,
            'main_big_category'   => App\Filters\Product\Frontend\MainBigCategoryFilter::class,
            'main_small_category' => App\Filters\Product\Frontend\MainSmallCategoryFilter::class,
        ],
        'stocks'   => [
            'stocks' => App\Filters\Product\Frontend\StockFilter::class,
            'stocks_sm' => App\Filters\Product\Frontend\StockFilter::class
        ],
    ],
];

