<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class MDOptimizeFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
	        return $image->resize(223, 155, function($img){
		        $img->aspectRatio();
	        })->resizeCanvas(223, 155);
        }
    }
