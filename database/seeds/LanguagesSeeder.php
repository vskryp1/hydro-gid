<?php

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Storage;
    use Unisharp\Setting\SettingFacade as Setting;

    /**
     * Class LanguagesSeeder
     */
    class LanguagesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
         */
        public function run(): void
        {
            $locales = [
                'ru' => ['id' => 'ru', 'name' => 'Русский', 'icon' => 'flags/ru.png'],
                'uk' => ['id' => 'uk', 'name' => 'Українська', 'icon' => 'flags/ua.png'],
            ];

            foreach ($locales as $locale) {
                $path = implode(DIRECTORY_SEPARATOR, ['assets', 'backend', 'images', $locale['icon']]);

                if (Storage::disk('public_files')->exists($path)) {
                    Storage::disk('public')->put($locale['icon'], File::get(resource_path($path)));
                }
            }

            Setting::set('locales', $locales);
        }
    }
