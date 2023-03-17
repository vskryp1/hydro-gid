<?php

    use App\Models\Page\Page;
    use App\Models\Sliders\Slider;
    use App\Models\Sliders\SliderItem;
    use Illuminate\Database\Seeder;

    /**
     * Class SliderSeeder
     */
    class SliderSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            //slider about us - our partner
            $slider_partners     = Slider::create([
                'active' => true,
                'alias'  => 'our-partner',
                'ru'     => [
                    'name' => 'Наши партнеры (о компании)',
                ],
                'uk'     => [
                    'name' => 'Наші партнери (о компании)',
                ],
            ]);

            $slider_items = [
                [
                    'active'    => true,
                    'position'  => 1,
                    'slider_id' => $slider_partners->id,
                    'ru'        => [
                        'title'       => '',
                        'name'        => '',
                        'description' => '',
                        'alt'         => '',
                        'image'       => '1.png',
                        'link'        => '',
                    ],
                ],
                [
                    'active'    => true,
                    'position'  => 2,
                    'slider_id' => $slider_partners->id,
                    'ru'        => [
                        'title'       => '',
                        'name'        => '',
                        'description' => '',
                        'alt'         => '',
                        'image'       => '2.png',
                        'link'        => '',
                    ],
                ],
                [
                    'active'    => true,
                    'position'  => 3,
                    'slider_id' => $slider_partners->id,
                    'ru'        => [
                        'title'       => '',
                        'name'        => '',
                        'description' => '',
                        'alt'         => '',
                        'image'       => '3.png',
                        'link'        => '',
                    ],
                ],
                [
                    'active'    => true,
                    'position'  => 4,
                    'slider_id' => $slider_partners->id,
                    'ru'        => [
                        'title'       => '',
                        'name'        => '',
                        'description' => '',
                        'alt'         => '',
                        'image'       => '2.png',
                        'link'        => '',
                    ],
                ],
            ];

            foreach ($slider_items as $slider_item) {
                $path = Slider::GALLERY_PATH . $slider_partners->id . '/' . $slider_item['ru']['image'];
                Storage::disk('public')
                    ->put($path,
                        File::get(resource_path('assets/frontend/images/partners/' . $slider_item['ru']['image']))
                    );
                SliderItem::create($slider_item);
            }

            //page about - slider gallery
            $slider_gallery     = Slider::create([
                'active' => true,
                'alias'  => 'gallery',
                'ru'     => [
                    'name' => 'Галерея (о компании)',
                ],
                'uk'     => [
                    'name' => 'Галерея (о компании)',
                ],
            ]);

            $slider_items = [
                [
                    'active'    => true,
                    'position'  => 1,
                    'slider_id' => $slider_gallery->id,
                    'ru'        => [
                        'title'       => '',
                        'name'        => '',
                        'description' => '',
                        'alt'         => '',
                        'image'       => 'image-1.jpg',
                        'link'        => '',
                    ],
                ],
                [
                    'active'    => true,
                    'position'  => 2,
                    'slider_id' => $slider_gallery->id,
                    'ru'        => [
                        'title'       => '',
                        'name'        => '',
                        'description' => '',
                        'alt'         => '',
                        'image'       => 'image-2.jpg',
                        'link'        => '',
                    ],
                ],
                [
                    'active'    => true,
                    'position'  => 3,
                    'slider_id' => $slider_gallery->id,
                    'ru'        => [
                        'title'       => '',
                        'name'        => '',
                        'description' => '',
                        'alt'         => '',
                        'image'       => 'image-2.jpg',
                        'link'        => '',
                    ],
                ],
                [
                    'active'    => true,
                    'position'  => 3,
                    'slider_id' => $slider_gallery->id,
                    'ru'        => [
                        'title'       => '',
                        'name'        => '',
                        'description' => '',
                        'alt'         => '',
                        'image'       => 'image-2.jpg',
                        'link'        => '',
                    ],
                ],

            ];

            foreach ($slider_items as $slider_item) {
                $path = Slider::GALLERY_PATH . $slider_gallery->id . '/' . $slider_item['ru']['image'];
                Storage::disk('public')
                    ->put($path,
                        File::get(resource_path('assets/frontend/images/content/about/' . $slider_item['ru']['image']))
                    );
                SliderItem::create($slider_item);
            }

        }
    }
