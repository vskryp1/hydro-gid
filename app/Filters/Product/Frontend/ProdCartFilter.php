<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class ProdCartFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
            return $image->fit(167, 112);
        }
    }
