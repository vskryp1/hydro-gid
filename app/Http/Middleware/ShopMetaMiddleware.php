<?php

    namespace App\Http\Middleware;

    use App\Models\Seo\SeoMetas;
    use App\Singletons\SeoMetaData;
    use Closure;
    use Config;

    class ShopMetaMiddleware
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
            $meta = $this->getMeta($request);

            if ($meta) {
                //1 step set meta tags of 4
                $seo_meta = app(SeoMetaData::class);
                $seo_meta->setSeoTitle($meta->seo_title);
                $seo_meta->setSeoDescription($meta->seo_description);
                $seo_meta->setSeoKeywords($meta->seo_keywords);
                $seo_meta->setSeoRobots($meta->seo_robots);
                $seo_meta->setSeoCanonical($meta->seo_canonical);
                $seo_meta->setSeoContent($meta->seo_content);
                $seo_meta->setStep(SeoMetaData::STEP_MODULE);
            }

            session()->put('login_redirect', $request->url());
            return $next($request);
        }

        private function getMeta($request)
        {
        	$path = $request->path ?? $request->path();

	        return SeoMetas::whereSeoUrl(trim($path, '/'))->first();
        }
    }
