<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Mcamara\LaravelLocalization\LanguageNegotiator;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationMiddlewareBase;

class CustomLocaleSessionRedirect extends LaravelLocalizationMiddlewareBase
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If the URL of the request is in exceptions.
        if ($this->shouldIgnore($request)) {
            return $next($request);
        }

        $params = explode('/', $request->path());
        $locale = session('locale', false);

        if (\count($params) > 0 && app('laravellocalization')->checkLocaleInSupportedLocales($params[0])) {
            if(array_key_exists($params[0], config('laravellocalization.redirectLocales')))
            {
                $locale = config('laravellocalization.redirectLocales')[$params[0]];
                $redirection = app('laravellocalization')->getLocalizedURL($locale);

                return new RedirectResponse($redirection, 301, ['Vary' => 'Accept-Language']);
            }
            session(['locale' => $params[0]]);

            return $next($request);
        }

        if (empty($locale) && app('laravellocalization')->hideUrlAndAcceptHeader()){
            // When default locale is hidden and accept language header is true,
            // then compute browser language when no session has been set.
            // Once the session has been set, there is no need
            // to negotiate language from browser again.
            $negotiator = new LanguageNegotiator(
                app('laravellocalization')->getDefaultLocale(),
                app('laravellocalization')->getSupportedLocales(),
                $request
            );
            $locale = $negotiator->negotiateLanguage();
            session(['locale' => $locale]);
        }

        if ($locale === false){
            $locale = app('laravellocalization')->getCurrentLocale();
        }

        if (
            $locale &&
            app('laravellocalization')->checkLocaleInSupportedLocales($locale) &&
            !(app('laravellocalization')->isHiddenDefault($locale))
        ) {
            app('session')->reflash();
            $redirection = app('laravellocalization')->getLocalizedURL($locale);

            return new RedirectResponse($redirection, 301, ['Vary' => 'Accept-Language']);
        }

        return $next($request);
    }
}
