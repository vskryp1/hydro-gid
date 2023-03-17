<?php

    namespace App\Jobs;

    use App\Enums\DeliveryType;
    use App\Models\Order\Delivery;
    use App\Models\Order\DeliveryPlace;
    use Cache;
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use InTime\InTime3;
    use Setting;

    class GetCitiesIntimeJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        public $timeout = 300;

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle()
        {
            if (config('app.intime_api_key')) {
                $intime   = new InTime3(config('app.intime_api_key'));
                $delivery = Delivery::whereType(DeliveryType::INTIME)->first();
                $areas    = json_decode($intime->get_area_list(), true);
                $locales  = Setting::get('locales');
                foreach ($locales as $locale => $data) {
                    if (isset($areas['Entry_get_area_by_id']) && count($areas['Entry_get_area_by_id']) > 0) {
                        foreach ($areas['Entry_get_area_by_id'] as $key => $area) {
                            $data = [
                                'api_id'      => $area['id'],
                                'position'    => $key,
                                'delivery_id' => $delivery->id,
                                $locale       => [
                                    'name'        => $area['short_name_' . $locale] ?? '',
                                    'description' => $area['name_' . $locale] ?? '',
                                ],
                            ];
                            DeliveryPlace::updateOrCreate(['api_id' => $area['id']], $data);
                        }
                    }
                }
                Cache::tags(['deliveries', 'intime'])->flush();
            }
        }
    }
