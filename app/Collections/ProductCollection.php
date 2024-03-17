<?php

    namespace App\Collections;

    use Illuminate\Database\Eloquent\Collection;

    class ProductCollection extends Collection
    {
        public function getItemsByCategories(): array
        {
            $data = [];

            $this->map(function($product) use (&$data) {
                $product->pages->map(function($page) use (&$data, $product) {
                    $data[$page->position]['page']                   = $page;
                    $data[$page->position]['products'][$product->id] = $product;
                });
            });

            ksort($data);

            return $data;
        }

	    public function getItemsByMainCategories(): array
	    {
		    $data = [];

		    $this->map(function($product) use (&$data) {
			    $page = $product->getMainCategoryAttribute();
			    if(isset($page)) {
                    $data[$page->id]['page'] = $page;
                    $data[$page->id]['products'][$product->id] = $product;
                }
		    });

		    ksort($data);

		    return $data;
	    }
    }
