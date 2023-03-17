<?php

    namespace App\Filters\Product\Backend;

    use Intervention\Image\Image;
    use Intervention\Image\Filters\FilterInterface;

    class GalleryFilter implements FilterInterface
    {
        public function applyFilter(Image $image)
        {
            return $image->fit(120, 120);
        }
    }
