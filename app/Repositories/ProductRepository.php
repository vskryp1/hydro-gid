<?php

    namespace App\Repositories;

    use App;
    use App\Events\UrlWasBorn;
    use App\Helpers\ShopHelper;
    use App\Jobs\ConvertPriceJob;
    use App\Jobs\RatingProductJob;
    use App\Jobs\ResizeImageJob;
    use App\Models\Filters\FilterValue;
    use App\Models\Product\ProductImage;
    use Cache;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Ramsey\Uuid\Uuid;
    use App\Models\Product\Product;

    class ProductRepository
    {
        protected $data;

        public function __construct(Request $request)
        {
            $this->data = $request->all();
        }


        /**
         * Update relations of product
         *
         * @param App\Models\Product\Product $product
         * @return bool
         */
        public function updateRelationModels($product)
        {
            //prepare and update model fields in product group if exists in request
            $fieldsGroup = [];
            if (isset($this->data['fields_group']) && count($this->data['fields_group']) > 0) {
                $fieldsGroup = array_intersect_key($this->data, $this->data['fields_group']);
                foreach ($product->all_group as $group_product) {
                    $group_product->update($fieldsGroup);
                }
            }

            //prepare category list
            $categories = [];
            foreach ($this->data['categories'] as $category) {
                $categories[$category] = [
                    'is_main' => $category == $this->data['main_category'],
                ];
            }
            //update categories in group or single
            if (!isset($fieldsGroup['categories'])) {
                $product->pages()->get()->map(function($page) use (&$categories)
                {
                    if(!$page->page_template()->first()->is_category)
                    {
                        $categories = array_merge($categories, [$page->id => ['is_main' => false]]);
                    }
                });
                $product->pages()->sync($categories);
            } else {
                foreach ($product->all_group as $group_product) {
                    $group_product->pages()->get()->map(function($page) use (&$categories)
                    {
                        if(!$page->page_template()->first()->is_category)
                        {
                            $categories = array_merge($categories, [$page->id => ['is_main' => false]]);
                        }
                    });
                    $group_product->pages()->sync($categories);
                }
            }

            //update images in group or single
            if (!isset($fieldsGroup['images'])) {
                $this->saveImages($product);
            } else {
                foreach ($product->all_group as $group_product) {
                    $this->saveImages($group_product);
                }
            }


            //prepare filters values
            $product_values = [];
            if (isset($this->data['filters']) && is_array($this->data['filters'])) {
                foreach ($this->data['filters'] as $filter_id => $filter) {
                    if (is_array($filter)) {
                        foreach ($filter as $value) {
                            if ($value != '') {
                                if (Uuid::isValid($value)) {
                                    $product_values[] = $value;
                                } else {
                                    $new_value        = FilterValue::create([
                                        'filter_id'      => $filter_id,
                                        'alias'          => Str::slug($value),
                                        App::getLocale() => ['name' => $value],
                                    ]);
                                    $product_values[] = $new_value->id;
                                }
                            }
                        }
                    }
                }
            }

            // update filters values in group or single
            if (!isset($fieldsGroup['filters'])) {
                $product->filter_values()->sync($product_values);
            } else {
                foreach ($product->all_group as $group_product) {
                    $group_product->filter_values()->sync($product_values);
                }
            }

            // change sitemap link in group or single
            $products = [];
            if (count($fieldsGroup) == 0) {
                event(new UrlWasBorn($product));
                $products[] = $product;
            } else {
                foreach ($product->all_group as $group_product) {
                    event(new UrlWasBorn($group_product));
                    $products[] = $group_product;
                }
            }

            // relations
	        $data_relations = (isset($this->data['relations']) && count($this->data['relations']) > 0)
                ? $this->data['relations']
                : [];
	        $product->productRelations()->sync($data_relations);

            // similar
            $similarIds = (isset($this->data['similar']) && count($this->data['similar']) > 0)
                ? $this->data['similar']
                : [];
            $product->similarProducts()->sync($similarIds);

            //calculate prices in default currency
            dispatch(new ConvertPriceJob(ShopHelper::default_currency(), collect($products), ['price', 'price_old']));

            // update rating_calculate in group or single
            if (!isset($fieldsGroup['rating_calculate'])) {
                dispatch(new RatingProductJob($product->id));
            } else {
                foreach ($product->all_group as $group_product) {
                    dispatch(new RatingProductJob($group_product->id));
                }
            }
            Cache::tags('products')->flush();
            return true;
        }

        /**
         * Prepare data to store
         *
         * @return array
         */
        public function prepareData($updateSellPrice = true)
        {
            //if ($updateSellPrice) {
                $this->data['original_price'] = $this->data['original_price_old'];
                $this->data['price'] = $this->data['original_price_old'];
                $this->data['price_old'] = $this->data['original_price_old'];
           // }
            $this->data['allow_default_warranty'] = isset($this->data['allow_default_warranty']);
            $this->data['active']                 = isset($this->data['active']);
            $this->data['is_disable_price']       = isset($this->data['is_disable_price']);
            $this->data['rating_calculate']       = $this->data['rating_calculate'] ?? 0;
            $this->data['rating']                 = $this->data['rating'] ?? 0;
            $this->data['parent_id']              = $this->data['parent_id'] ?? null;
            $this->data['technical_doc']          = $this->data['technical_doc'] ?? $this->data['technical_doc_name'] ?? '';

            return $this->data;
        }

        /**
         * Save product images
         *
         * @param $product
         */
        public function saveImages($product)
        {
           // $product->images()->delete();
            if (isset($this->data['images']) && is_array($this->data['images'])) {
                $pos = 0;
                foreach ($this->data['images'] as $image) {

                    if (!is_null($image['image'])) {
                        $filePath = collect([ 'products', $product->id, $image['image']])->implode(DIRECTORY_SEPARATOR);

                        $fff = new ResizeImageJob(
                                $filePath,
                                config('customimagecache.types.products'),
                                'products'
                            );

                        $fff->handle();

                        $image['product_id'] = $product->id;
                        $image['cover']      = $pos == 0;
                        $image['position']   = $pos++;
                        ProductImage::create($image);
                    }
                }
            }
        }

    }