<?php

    namespace App\Jobs;

    use App\Enums\DeliveryType;
    use App\Helpers\ShopHelper;
    use App\Models\Order\Delivery;
    use App\Models\Order\DeliveryPlace;
    use Cache;
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use LisDev\Delivery\NovaPoshtaApi2;

    class GetCitiesNPJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $locale;
        public    $timeout = 300;

        /**
         * Create a new job instance.
         *
         * @return void
         */
        public function __construct($locale = false)
        {
            $this->locale = $locale ?? config('app.locale');
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle()
        {
            if (ShopHelper::np_api_key()) {
                $np       = new NovaPoshtaApi2(ShopHelper::np_api_key(), $this->locale);
                $delivery = Delivery::whereType(DeliveryType::PICKUP_NP)->first();
                $cities   = $np->getCities();
                foreach ($cities['data'] as $city) {
                    $delivery_place = DeliveryPlace::where('api_id', $city['Ref'])->first();
                    $data           = [
                        'api_id'      => $city['Ref'],
                        'delivery_id' => $delivery->id,
                        $this->locale => [
                            'name'        => $this->locale == 'ru' && isset($city['DescriptionRu'])
                                ? $city['DescriptionRu']
                                : $city['Description'],
                            'description' => $this->locale == 'ru' && isset($city['SettlementTypeDescriptionRu'])
                                ? $city['SettlementTypeDescriptionRu']
                                : (isset($city['SettlementTypeDescription'])
                                    ? $city['SettlementTypeDescription']
                                    : ''),
                        ],
                    ];
                    if ($delivery_place) {
                        $delivery_place->update($data);
                    } else {
                        $data['position'] = $city['CityID'] ?? rand(1000, 9999);
                        DeliveryPlace::create($data);
                    }
                }
                Cache::tags('deliveries')->flush();
            }
        }
    }
