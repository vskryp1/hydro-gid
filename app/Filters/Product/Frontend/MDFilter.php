<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class MDFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
	        return $image->resize(675, 470, function($img){
		        $img->aspectRatio();
	        })->resizeCanvas(675, 470);
        }
    }
