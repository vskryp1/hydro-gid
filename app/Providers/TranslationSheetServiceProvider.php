<?php

    namespace App\Providers;

    use Nikaia\TranslationSheet\Spreadsheet;
    use Nikaia\TranslationSheet\TranslationSheetServiceProvider as TranslationSheetServiceProviderPackage;
    use Nikaia\TranslationSheet\Client\Client;
    use Nikaia\TranslationSheet\Commands\Lock;
    use Nikaia\TranslationSheet\Commands\Open;
    use Nikaia\TranslationSheet\Commands\Pull;
    use Nikaia\TranslationSheet\Commands\Push;
    use Nikaia\TranslationSheet\Commands\Setup;
    use Nikaia\TranslationSheet\Commands\Status;
    use Nikaia\TranslationSheet\Commands\Unlock;
    use Nikaia\TranslationSheet\Commands\Prepare;
    use Symfony\Component\Finder\Finder;

    class TranslationSheetServiceProvider extends TranslationSheetServiceProviderPackage
    {
        protected $locales;

        protected $ignoreLocales;

        public function boot()
        {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('translation_sheet.php'),
            ], 'config');
        }

        public function register()
        {
            $this->registerGoogleApiClient();

            $this->registerSpreadsheet();

            $this->registerCommands();
        }

        private function registerGoogleApiClient()
        {
            $this->app->singleton(Client::class, function() {
                return Client::create(
                    $this->app['config']['translation_sheet.serviceAccountCredentialsFile'],
                    $this->app['config']['translation_sheet.googleApplicationName']
                );
            });
        }

        private function registerSpreadsheet()
        {
            if (empty($this->locales)) {
                $locales     = [];
                $directories = Finder::create()
                    ->in(base_path('resources/lang'))
                    ->directories()
                    ->depth(0)
                    ->sortByName();

                foreach ($directories as $directory) {
                    $directoryName = basename($directory->getPathname());

                    if ($directoryName !== 'vendor') {
                        $locales[] = $directoryName;
                    }
                }

                $this->locales = array_unique($locales);
                sort($this->locales);
                $this->locales = array_diff($this->locales, config('translation-manager.exclude_langs'));
            }

            $this->app->singleton(Spreadsheet::class, function() {
                return new Spreadsheet(
                    $this->app['config']['translation_sheet.spreadsheetId'],
                    $this->locales
                );
            });
        }

        private function registerCommands()
        {
            $this->commands([
                Setup::class,
                Push::class,
                Pull::class,
                Prepare::class,
                Lock::class,
                Unlock::class,
                Status::class,
                Open::class,
            ]);
        }
    }
