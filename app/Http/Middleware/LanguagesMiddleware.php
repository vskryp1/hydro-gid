<?php

    namespace App\Http\Middleware;

    use App\Helpers\ShopHelper;
    use Closure;
    use Illuminate\Support\Facades\App;
    use LaravelLocalization;

    class LanguagesMiddleware
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure                 $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            //check languages from config
            $locales = array_keys(ShopHelper::setting('locales', [], false));
            if (count($locales) > 0) {
                if (!in_array(config('app.locale'), $locales) || !in_array(config('app.fallback_locale'), $locales)) {
                    $locale = reset($locales);
                    config()->set('app.locale', $locale);
                    config()->set('app.fallback_locale', $locale);
                    config()->set('translatable.locale', $locale);
                    config()->set('translatable.fallback_locale', $locale);
                    LaravelLocalization::setLocale($locale);
                }
                config()->set('translation_sheet.locales', $locales);

                $supportedLocales = config('laravellocalization.supportedLocales');
                config()->set('laravellocalization.supportedLocales', []);
                foreach ($locales as $locale) {
                    if (isset($supportedLocales[$locale])) {
                        config()->set('laravellocalization.supportedLocales.' . $locale, $supportedLocales[$locale]);
                    }
                }
            }

            //change Carbon locale
	        if(App::getLocale() == 'ua'){
		        \Carbon\Carbon::setLocale('uk');
	        }

            return $next($request);
        }
    }
