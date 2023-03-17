<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class MainServiceFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
            $width  = 560;
            $height = 364;
            return $image->resize($width, $height,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
        }
    }
