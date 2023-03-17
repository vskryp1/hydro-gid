<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class SliderSlimFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
	        return $image->fit(324, 470, function ($constraint) {
		        $constraint->upsize();
	        });
        }
    }
