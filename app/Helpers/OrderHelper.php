<?php


    namespace App\Helpers;


    use App\Enums\DeliveryType;
    use App\Models\Order\Order;
    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\App;
    use LisDev\Delivery\NovaPoshtaApi2;

    class OrderHelper
    {
        public static function getWarehouseInfo($order)
        {
            $locale          = App::getLocale();
            $warehouses      = [];

            if ($order->delivery && $order->delivery->type->is(DeliveryType::PICKUP_NP)) {
                $np              = new NovaPoshtaApi2($order->delivery->api_key, $locale);
                if ($order->delivery_place) {
                    $np_wh = $np->getWarehouses($order->delivery_place->api_id);
                    if (isset($np_wh['data']) && count($np_wh['data']) > 0) {
	                    $need_location = $locale == 'ru' ? 'Ru' : '';
                        foreach ($np_wh['data'] as $warehouse) {
                            $warehouses[$warehouse['Ref']] = implode(', ', [$warehouse['CityDescription' . $need_location], $warehouse['Description' . $need_location]]);
                        }
                    }
                }
            }

            return $warehouses;
        }

        /**
         * @param \App\Models\Order\Order $order
         *
         * @return string
         */
        public static function getWarehouse(Order $order)
        {
            return $order->warehouse_id
                ? Arr::get(self::getWarehouseInfo($order), $order->warehouse_id, __('frontend.delivery'))
                : '';
        }
    }