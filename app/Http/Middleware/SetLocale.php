<?php

namespace App\Http\Middleware;

use App\Helpers\ShopHelper;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Setting;

class SetLocale
{
    /**
     * Смена языка
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = Session::get('backend_locale');
        if(!array_key_exists($locale, ShopHelper::setting('locales', [], false))){
            $locale = config('app.fallback_locale');
        }
        config(['lang' => ShopHelper::setting('locales', [], false)[$locale]]);
        App::setLocale($locale);

        return $next($request);
    }
}
