<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class CategoryFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
	        return $image->resize(111, 111, function($img){
		        $img->aspectRatio();
	        });
        }
    }
