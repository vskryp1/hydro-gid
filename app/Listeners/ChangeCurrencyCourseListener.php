<?php

    namespace App\Listeners;

    use App\Events\ChangeCurrencyCourseEvent;
    use App\Helpers\ShopHelper;
    use App\Jobs\ConvertPriceJob;
    use App\Models\Order\Delivery;
    use App\Models\Product\Product;
    use Cache;

    class ChangeCurrencyCourseListener
    {
        public function handle(ChangeCurrencyCourseEvent $event)
        {
            Cache::tags('currencies')->flush();
            //products prices
            Product::with('currency')->chunk(100, function($products) {
                dispatch(new ConvertPriceJob(ShopHelper::default_currency(), $products, ['price', 'price_old']));
            });

            //deliveries prices
            Delivery::with('currency')->chunk(100, function($deliveries) {
                dispatch(new ConvertPriceJob(ShopHelper::default_currency(), $deliveries, ['price']));
            });

        }
    }
