<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class XLFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
            $width  = 810;
            $height = 543;
            return $image->resize($width, $height,
                function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas($width, $height);
        }
    }
