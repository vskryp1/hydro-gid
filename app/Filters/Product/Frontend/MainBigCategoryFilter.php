<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class MainBigCategoryFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
            return $image->resize(270, 234, function($img){
                $img->aspectRatio();
            })->resizeCanvas(270, 234);
        }
    }
