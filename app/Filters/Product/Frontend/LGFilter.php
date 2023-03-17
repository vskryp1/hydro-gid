<?php

    namespace App\Filters\Product\Frontend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class LGFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
	        return $image->fit(675, 470, function ($constraint) {
		        $constraint->upsize();
	        });
        }
    }
