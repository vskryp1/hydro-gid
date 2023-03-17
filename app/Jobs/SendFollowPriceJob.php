<?php

    namespace App\Jobs;

    use App;
    use App\Mail\Frontend\FollowPriceMail;
    use App\Models\Currency\Currency;
    use App\Models\Product\Product;
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use Mail;

    class SendFollowPriceJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        public $clients;
        public $product;
        public $old_currency;
        public $old_price;

        /**
         * SendFollowPriceJob constructor.
         * @param          $clients
         * @param Product  $product
         * @param          $old_price
         * @param Currency $old_currency
         */
        public function __construct($clients, Product $product, Currency $old_currency, $old_price)
        {
            $this->clients      = $clients;
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
            foreach ($this->clients as $client) {
                Mail::to($client->email)->queue((new FollowPriceMail([
                    'product'      => $this->product,
                    'old_currency' => $this->old_currency,
                    'old_price'    => $this->old_price,
                    'locale'       => App::getLocale()
                ]))->onQueue('default'));
            }
        }
    }
