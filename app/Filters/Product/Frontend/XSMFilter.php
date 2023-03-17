<?php


    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class XSMFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
            return $image->heighten(70);
        }
    }
