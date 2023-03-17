<?php

    namespace App\Observers;

    use App\Enums\ProductAvailability;
    use App\Jobs\ChangeProductStatusJob;
    use App\Models\Product\Product;
    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    class ProductObserver
    {
        public function creating(Product $product)
        {
            if (! $product->getKey()) {
                $product->{$product->getKeyName()} = (string)Str::uuid();
            }

            if (is_null($product->parent_id)) {
                $product->parent_id = $product->getKey();
            }
        }

        public function saving(Product $product)
        {
            if ($product->technical_doc instanceof UploadedFile) {
                $file = Storage::disk('public')
                    ->putFile(Product::GALLERY_PATH . $product->id, $product->technical_doc);

                $product->technical_doc = basename($file);
            }
        }

        public function updated(Product $product)
        {
            if($product->isDirty('availability') && $product->getOriginal('availability') == ProductAvailability::NOT_AVAILABLE)
            {
                dispatch(new ChangeProductStatusJob($product));
            }
        }
    }
