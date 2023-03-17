<?php

    namespace App\Jobs;

    use App\Helpers\ShopHelper;
    use App\Models\Product\Product;
    use Cache;
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;

    class RatingProductJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $product_id;

        /**
         * ConvertPriceJob constructor.
         *
         * @param      $product_id
         */
        public function __construct($product_id)
        {
            $this->product_id  = $product_id;
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle()
        {
            $product = Product::find($this->product_id);
            $reviews_cnt = $product->reviews()->onlyActive()->count();
            if($product && $product->rating_calculate && $reviews_cnt) {
                $product->update(['rating' => $product->reviews()->onlyActive()->avg('rating')??0]);
            }
            Cache::tags('reviews')->flush();
        }
    }