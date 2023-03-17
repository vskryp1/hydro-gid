<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class StockSMFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
            return $image->fit(200);
        }
    }
