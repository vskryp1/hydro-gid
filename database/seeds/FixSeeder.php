<?php

    use App\Enums\DeliveryType;
    use App\Models\Order\Delivery;
    use App\Models\Page\PageTemplate;
    use Illuminate\Database\Seeder;
    use App\Models\Page\PageAdditionalField;
    use App\Models\Page\PageAdditionalFieldType;
    use App\Jobs\GetCitiesNPJob;

    /**
     * Class BlogSeeder
     */
    class FixSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            // fix blog file add fields
            $pageTemplate = PageTemplate::where('folder', 'blog_one')->first();
            if ($pageTemplate) {
                PageAdditionalField::updateOrCreate(['key' => 'image'], [
                    'page_template_id'              => $pageTemplate->id,
                    'key'                           => 'image',
                    'page_additional_field_type_id' => PageAdditionalFieldType::where('type', 'file')->first()->id,
                    'name'                          => 'картинка блога',
                ]);

                // clear duplicates from delivery place (только новая почта)
                $delivery = Delivery::whereType(DeliveryType::PICKUP_NP)->first();
                $delivery->delivery_places()->delete();
                dispatch(new GetCitiesNPJob('ru'));

                // fix format of schedule
                Setting::lang('ru')->set('schedule', json_encode([
                    [
                        'day'      => 'Пн - Пт',
                        'full_day' => 'Пн - Пт',
                        'time'     => '09.00 - 19.00',
                    ],
                    [
                        'day'      => 'Сб',
                        'full_day' => 'Cуббота',
                        'time'     => '09.00 - 15.00',
                    ],
                    [
                        'day'      => 'Вс',
                        'full_day' => 'Воскресенье',
                        'time'     => 'Выходной',
                    ],
                ], JSON_UNESCAPED_UNICODE));
                Setting::lang('uk')->set('schedule', json_encode([
                    [
                        'day'      => 'Пн - Пт',
                        'full_day' => 'Пн - Пт',
                        'time'     => '09.00 - 19.00',
                    ],
                    [
                        'day'      => 'Сб',
                        'full_day' => 'Cуббота',
                        'time'     => '09.00 - 15.00',
                    ],
                    [
                        'day'      => 'Нд',
                        'full_day' => 'Неділя',
                        'time'     => 'Вихідний',
                    ],
                ], JSON_UNESCAPED_UNICODE));
            }
        }
    }
