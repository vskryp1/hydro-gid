<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class SliderSmFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
	        return $image->fit(324, 220, function ($constraint) {
		        $constraint->upsize();
	        });
        }
    }
