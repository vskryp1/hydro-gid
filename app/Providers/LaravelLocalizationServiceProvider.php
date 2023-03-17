<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
    use Mcamara\LaravelLocalization\Commands\RouteTranslationsCacheCommand;
    use Mcamara\LaravelLocalization\Commands\RouteTranslationsClearCommand;
    use Mcamara\LaravelLocalization\Commands\RouteTranslationsListCommand;
    use Mcamara\LaravelLocalization\LaravelLocalization;
    use Symfony\Component\Finder\Finder;

    class LaravelLocalizationServiceProvider extends ServiceProvider
    {
        public function boot()
        {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('laravellocalization.php'),
            ], 'config');
        }

        public function provides()
        {
            return [
                'modules.handler',
                'modules',
            ];
        }

        public function register()
        {
            $this->registerBindings();

            $this->registerCommands();
        }

        protected function registerBindings()
        {
            $localizations = new LaravelLocalization();

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

                $locales = array_unique($locales);
                sort($locales);
                $localizations->setSupportedLocales(
                    array_diff($locales, config('laravellocalization.supportedLocales'))
                );
            }

            $this->app->singleton(LaravelLocalization::class, function() use ($localizations) {
                return $localizations;
            });

            $this->app->alias(LaravelLocalization::class, 'laravellocalization');
        }

        protected function registerCommands()
        {
            $this->app->singleton('laravellocalizationroutecache.cache', RouteTranslationsCacheCommand::class);
            $this->app->singleton('laravellocalizationroutecache.clear', RouteTranslationsClearCommand::class);
            $this->app->singleton('laravellocalizationroutecache.list', RouteTranslationsListCommand::class);

            $this->commands([
                'laravellocalizationroutecache.cache',
                'laravellocalizationroutecache.clear',
                'laravellocalizationroutecache.list',
            ]);
        }
    }
