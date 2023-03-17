<?php

namespace App\Http\Middleware;

use App\Models\Seo\SeoRedirects;
use Closure;

class ShopRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //redirect if page parameter <= 1
        if($request->has(config('app.separators.category.pages')) && $request->{config('app.separators.category.pages')} < 2){
            return redirect($request->path(), 301);
        }

        //filter uri
        $uri = $request->getRequestUri();

        //remove double sign
        $uri = preg_replace('!([-|\/|_|&|=|$|\\|?|*|\(|\)|\[|\]|\+])\1!u', '$1', $uri);

        //remove slash from end
        $uri = preg_replace('!\/$!u', '', $uri);
        if($request->getRequestUri() != $uri){
            return redirect($uri, 301);
        }

        //check url in redirects module
        $redirect = SeoRedirects::whereFrom($request->path())->first();
        if($redirect){
            return redirect($redirect->to, $redirect->status_code);
        }
        return $next($request);
    }
}
