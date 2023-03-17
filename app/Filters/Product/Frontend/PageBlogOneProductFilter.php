<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class PageBlogOneProductFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
            return $image->fit(143, 96);
        }
    }
