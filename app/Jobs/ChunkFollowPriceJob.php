<?php

    namespace App\Jobs;

    use App\Models\Currency\Currency;
    use App\Models\Product\Product;
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;

    class ChunkFollowPriceJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


        public $product;
        public $old_currency;
        public $old_price;

        /**
         * ChunkFollowPriceJob constructor.
         * @param Product  $product
         * @param          $old_price
         * @param Currency $old_currency
         */
        public function __construct(Product $product, Currency $old_currency, $old_price)
        {
            $this->product      = $product;
            $this->old_currency = $old_currency;
            $this->old_price    = $old_price;
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle()
        {
            $product      = $this->product;
            $old_price    = $this->old_price;
            $old_currency = $this->old_currency;
            $this->product->follow_price()->chunk(500, function ($clients) use ($product, $old_price, $old_currency) {
                dispatch(new SendFollowPriceJob($clients, $product, $old_currency, $old_price));
            });

        }
    }
