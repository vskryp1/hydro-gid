<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class MainSmallCategoryFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
            return $image->resize(113, 113, function($img){
                $img->aspectRatio();
            })->resizeCanvas(113, 113);
        }
    }
