<?php

    namespace App\Http;

    use Illuminate\Foundation\Http\Kernel as HttpKernel;

    /**
     * Class Kernel
     *
     * @package App\Http
     */
    class Kernel extends HttpKernel
    {
        /**
         * The application's global HTTP middleware stack.
         *
         * These middleware are run during every request to your application.
         *
         * @var array
         */
        protected $middleware = [
            \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
            \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            \App\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
            \App\Http\Middleware\TrustProxies::class,
            \Matthewbdaly\ETagMiddleware\ETag::class,
            \Clockwork\Support\Laravel\ClockworkMiddleware::class,
        ];

        /**
         * The application's route middleware groups.
         *
         * @var array
         */
        protected $middlewareGroups = [
            'web' => [
                \App\Http\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                // \Illuminate\Session\Middleware\AuthenticateSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \App\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
                \App\Http\Middleware\LanguagesMiddleware::class,
            ],

            'adminer' => [
                \App\Http\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \App\Http\Middleware\AdminerAuthenticated::class,
            ],

            'api' => [
                'throttle:60,1',
                'bindings',
            ],
        ];

        /**
         * The application's route middleware.
         *
         * These middleware may be assigned to groups or used individually.
         *
         * @var array
         */
        protected $routeMiddleware = [
            'auth'                  => \Illuminate\Auth\Middleware\Authenticate::class,
            'auth.basic'            => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'bindings'              => \Illuminate\Routing\Middleware\SubstituteBindings::class,
            'cache.headers'         => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can'                   => \Illuminate\Auth\Middleware\Authorize::class,
            'guest'                 => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'signed'                => \Illuminate\Routing\Middleware\ValidateSignature::class,
            'throttle'              => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'role'                  => \Spatie\Permission\Middlewares\RoleMiddleware::class,
            'permission'            => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
            'ajax'                  => \App\Http\Middleware\AjaxMiddleware::class,
            'page'                  => \App\Http\Middleware\PageMiddleware::class,
            'lowercase'             => \App\Http\Middleware\LowercaseRoutes::class,
            'localize'              => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'  => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect' => \App\Http\Middleware\CustomLocaleSessionRedirect::class,
            'localeViewPath'        => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'setLocale'             => \App\Http\Middleware\SetLocale::class,
            'shopRedirect'          => \App\Http\Middleware\ShopRedirectMiddleware::class,
            'shopMeta'              => \App\Http\Middleware\ShopMetaMiddleware::class,
            'adminer'               => \App\Http\Middleware\AdminerAuthenticated::class,
            'verified'              => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'sweet-alert'           => \RealRashid\SweetAlert\ToSweetAlert::class,
            'cache-control'         => \App\Http\Middleware\CacheControl::class
        ];
    }
