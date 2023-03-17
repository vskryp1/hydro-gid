<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class SliderFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
	        return $image->resize(null, 386, function($img){
		        $img->aspectRatio();
	        });
        }
    }
