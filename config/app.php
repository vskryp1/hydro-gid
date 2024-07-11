<?php

    return [

        /*
        |--------------------------------------------------------------------------
        | Application Name
        |--------------------------------------------------------------------------
        |
        | This value is the name of your application. This value is used when the
        | framework needs to place the application's name in a notification or
        | any other location as required by the application or its packages.
        |
        */

        'name' => env('APP_NAME', 'Laravel'),

        /*
        |--------------------------------------------------------------------------
        | Application Environment
        |--------------------------------------------------------------------------
        |
        | This value determines the "environment" your application is currently
        | running in. This may determine how you prefer to configure various
        | services your application utilizes. Set this in your ".env" file.
        |
        */

        'env' => env('APP_ENV', 'production'),

        /*
        |--------------------------------------------------------------------------
        | Application Debug Mode
        |--------------------------------------------------------------------------
        |
        | When your application is in debug mode, detailed error messages with
        | stack traces will be shown on every error that occurs within your
        | application. If disabled, a simple generic error page is shown.
        |
        */

        'debug' => env('APP_DEBUG', true),

        /*
        |--------------------------------------------------------------------------
        | Application URL
        |--------------------------------------------------------------------------
        |
        | This URL is used by the console to properly generate URLs when using
        | the Artisan command line tool. You should set this to the root of
        | your application so that it is used when running Artisan tasks.
        |
        */

        'url' => env('APP_URL', 'http://localhost'),

        /*
        |--------------------------------------------------------------------------
        | Application Timezone
        |--------------------------------------------------------------------------
        |
        | Here you may specify the default timezone for your application, which
        | will be used by the PHP date and date-time functions. We have gone
        | ahead and set this to a sensible default for you out of the box.
        |
        */

        'timezone' => env("APP_TIMEZONE", "Europe/Kiev"),

        /*
        |--------------------------------------------------------------------------
        | Application Locale Configuration
        |--------------------------------------------------------------------------
        |
        | The application locale determines the default locale that will be used
        | by the translation service provider. You are free to set this value
        | to any of the locales which will be supported by the application.
        |
        */

        'locale' => 'uk',

        /*
        |--------------------------------------------------------------------------
        | Application Fallback Locale
        |--------------------------------------------------------------------------
        |
        | The fallback locale determines the locale to use when the current one
        | is not available. You may change the value to correspond to any of
        | the language folders that are provided through your application.
        |
        */

        'fallback_locale' => 'uk',

        /*
        |--------------------------------------------------------------------------
        | Encryption Key
        |--------------------------------------------------------------------------
        |
        | This key is used by the Illuminate encrypter service and should be set
        | to a random, 32 character string, otherwise these encrypted strings
        | will not be safe. Please do this before deploying an application!
        |
        */

        'key' => env('APP_KEY'),

        'cipher' => 'AES-256-CBC',

        /*
        |--------------------------------------------------------------------------
        | Autoloaded Service Providers
        |--------------------------------------------------------------------------
        |
        | The service providers listed here will be automatically loaded on the
        | request to your application. Feel free to add your own services to
        | this array to grant expanded functionality to your applications.
        |
        */

        'providers' => [

            /*
             * Laravel Framework Service Providers...
             */
            Illuminate\Auth\AuthServiceProvider::class,
            Illuminate\Broadcasting\BroadcastServiceProvider::class,
            Illuminate\Bus\BusServiceProvider::class,
            Illuminate\Cache\CacheServiceProvider::class,
            Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
            Illuminate\Cookie\CookieServiceProvider::class,
            Illuminate\Database\DatabaseServiceProvider::class,
            Illuminate\Encryption\EncryptionServiceProvider::class,
            Illuminate\Filesystem\FilesystemServiceProvider::class,
            Illuminate\Foundation\Providers\FoundationServiceProvider::class,
            Illuminate\Hashing\HashServiceProvider::class,
            Illuminate\Mail\MailServiceProvider::class,
            Illuminate\Notifications\NotificationServiceProvider::class,
            Illuminate\Pagination\PaginationServiceProvider::class,
            Illuminate\Pipeline\PipelineServiceProvider::class,
            Illuminate\Queue\QueueServiceProvider::class,
            Illuminate\Redis\RedisServiceProvider::class,
            Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
            Illuminate\Session\SessionServiceProvider::class,
            Illuminate\Translation\TranslationServiceProvider::class,
            Illuminate\Validation\ValidationServiceProvider::class,
            Illuminate\View\ViewServiceProvider::class,

            /*
             * Package Service Providers...
             */
            Maatwebsite\Excel\ExcelServiceProvider::class,
            Unisharp\Setting\SettingServiceProvider::class,
            Collective\Html\HtmlServiceProvider::class,
            Intervention\Image\ImageServiceProvider::class,
            UniSharp\LaravelFilemanager\LaravelFilemanagerServiceProvider::class,
            Proengsoft\JsValidation\JsValidationServiceProvider::class,
            Sentry\Laravel\ServiceProvider::class,
            Barryvdh\DomPDF\ServiceProvider::class,
            RealRashid\SweetAlert\SweetAlertServiceProvider::class,
            Clockwork\Support\Laravel\ClockworkServiceProvider::class,

            /*
             * Application Service Providers...
             */
            App\Providers\AppServiceProvider::class,
            App\Providers\AuthServiceProvider::class,
            App\Providers\EventServiceProvider::class,
            App\Providers\LfmServiceProvider::class,
            App\Providers\RouteServiceProvider::class,
            App\Providers\ComposerServiceProvider::class,
            App\Providers\QueueServiceProvider::class,
            // App\Providers\BroadcastServiceProvider::class,
            App\Providers\TranslationSheetServiceProvider::class,
            App\Providers\BladeServiceProvider::class,
        ],

        /*
        |--------------------------------------------------------------------------
        | Class Aliases
        |--------------------------------------------------------------------------
        |
        | This array of class aliases will be registered when this application
        | is started. However, feel free to register as many as you wish as
        | the aliases are "lazy" loaded so they don't hinder performance.
        |
        */

        'aliases' => [
            'App'                 => Illuminate\Support\Facades\App::class,
            'Artisan'             => Illuminate\Support\Facades\Artisan::class,
            'Auth'                => Illuminate\Support\Facades\Auth::class,
            'Blade'               => Illuminate\Support\Facades\Blade::class,
            'Broadcast'           => Illuminate\Support\Facades\Broadcast::class,
            'Bus'                 => Illuminate\Support\Facades\Bus::class,
            'Cache'               => Illuminate\Support\Facades\Cache::class,
            'Config'              => Illuminate\Support\Facades\Config::class,
            'Cookie'              => Illuminate\Support\Facades\Cookie::class,
            'Crypt'               => Illuminate\Support\Facades\Crypt::class,
            'DB'                  => Illuminate\Support\Facades\DB::class,
            'Eloquent'            => Illuminate\Database\Eloquent\Model::class,
            'Event'               => Illuminate\Support\Facades\Event::class,
            'File'                => Illuminate\Support\Facades\File::class,
            'Gate'                => Illuminate\Support\Facades\Gate::class,
            'Hash'                => Illuminate\Support\Facades\Hash::class,
            'Lang'                => Illuminate\Support\Facades\Lang::class,
            'Log'                 => Illuminate\Support\Facades\Log::class,
            'Mail'                => Illuminate\Support\Facades\Mail::class,
            'Notification'        => Illuminate\Support\Facades\Notification::class,
            'Password'            => Illuminate\Support\Facades\Password::class,
            'Queue'               => Illuminate\Support\Facades\Queue::class,
            'Redirect'            => Illuminate\Support\Facades\Redirect::class,
            'Redis'               => Illuminate\Support\Facades\Redis::class,
            'Request'             => Illuminate\Support\Facades\Request::class,
            'Response'            => Illuminate\Support\Facades\Response::class,
            'Route'               => Illuminate\Support\Facades\Route::class,
            'Schema'              => Illuminate\Support\Facades\Schema::class,
            'Session'             => Illuminate\Support\Facades\Session::class,
            'Storage'             => Illuminate\Support\Facades\Storage::class,
            'Str'                 => Illuminate\Support\Str::class,
            'URL'                 => Illuminate\Support\Facades\URL::class,
            'Validator'           => Illuminate\Support\Facades\Validator::class,
            'View'                => Illuminate\Support\Facades\View::class,
            'Carbon'              => Carbon\Carbon::class,
            'JsValidator'         => Proengsoft\JsValidation\Facades\JsValidatorFacade::class,
            'Image'               => Intervention\Image\Facades\Image::class,
            'Form'                => Collective\Html\FormFacade::class,
            'Html'                => Collective\Html\HtmlFacade::class,
            'Setting'             => Unisharp\Setting\SettingFacade::class,
            'Breadcrumbs'         => DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::class,
            'LaravelLocalization' => Mcamara\LaravelLocalization\Facades\LaravelLocalization::class,
            'Cart'                => Gloudemans\Shoppingcart\Facades\Cart::class,
            'Sentry'              => Sentry\Laravel\Facade::class,
            'PDF'                 => Barryvdh\DomPDF\Facade::class,
            'Filter'              => App\Models\Filters\Filter::class,
            'Alert'               => RealRashid\SweetAlert\Facades\Alert::class,
            'Excel'               => Maatwebsite\Excel\Facades\Excel::class,

            /* Template aliases */
            'ShopHelper'          => App\Helpers\ShopHelper::class,
            'CartHelper'          => App\Helpers\CartHelper::class,
            'PageHelper'          => App\Helpers\PageHelper::class,
            'MenuHelper'          => App\Helpers\MenuHelper::class,
            'ProductHelper'       => App\Helpers\ProductHelper::class,
            'CategoryHelper'      => App\Helpers\CategoryHelper::class,
            'ProductAvailability' => App\Enums\ProductAvailability::class,
            'ProductSaleType'     => App\Enums\ProductSaleType::class,
            'UserType'            => App\Enums\UserType::class,
            'PageAlias'           => App\Enums\PageAlias::class,
            'ServiceType'         => App\Enums\ServiceType::class,
            'PaymentType'         => App\Enums\PaymentType::class,
            'DeliveryType'        => App\Enums\DeliveryType::class,
            'Review'              => App\Models\Reviews\Review::class,
            'Page'                => App\Models\Page\Page::class,
        ],

        'formats' => [
            'php' => [
                'date'     => 'Y-m-d',
                'time'     => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],
            'js'  => [
                'date'     => 'YYYY-MM-DD',
                'time'     => 'hh:mm:ss',
                'datetime' => 'yyyy-mm-dd hh:mm:ss',
            ],
        ],

        'mail_template_limit' => 12,
        'template_limit'      => 12,

        'limits' => [
            'backend'  => [
                'pagination' => 20,
            ],
            'frontend' => [
                'products'       => 4,
                'reviews'        => 6,
                'similar'        => 20,
                'related'        => 20,
                'articles'       => 3,
                'last_articles'  => 3,
                'delivery_place' => 50,
                'faq'            => 10,
                'stock'          => 6,
                'stock_main'     => 2,
            ],
        ],

        'default_promocode_name' => 'PROMOCODE',
        'promocode_discount_max' => 30,
        'promocode_discount_min' => 1,

        'np_get_time'                         => '01:00',
        'currencies_get_time'                 => '01:00',
        'stock_price_time_calc'               => '00:00',
        'products_availability_update_time'   => '03:00',
        'sitemap_image_generate'              => '03:30',
        'merchant_feed_generate'              => '04:00',
        'facebook_feed_generate'              => '04:15',
        'currencylayer_api_key' => env('CURRENCYLAYER_API_KEY', false),

        'image_mimes'      => 'jpeg,jpg,png',
        'file_mimes'       => 'jpeg,jpg,png,pdf,txt,doc,docx,rtf,odt,zip',
        'file_mimes_front' => [
            'image/x-png',
            'image/gif',
            'image/jpeg',
            'application/pdf',
            'text/plain',
            'application/msword',
            'application/rtf',
            'application/x-rtf',
            'text/richtext',
            'application/rtf',
            'text/richtext',
            'application/vnd.oasis.opendocument.text',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ],
        'image_size'       => 6000,
        'file_size'        => 6000,

        'cache_minutes' => env('CACHE_MINUTES', 3600),

        'no_avatar'        => 'assets/frontend/images/no_avatar.png',
        'no_image'         => 'assets/frontend/images/no_image.png',
        'no_product_image' => 'assets/backend/images/no_image_2.png',

        'alias_chars' => 'A-Za-z0-9\-_:\/',
        'phone_chars' => '\(\)0-9\+\-\s',

        'separators' => [
            'category' => [
                'pages' => 'page',
            ],
            'filters'  => [
                'start'         => '',
                'filter_filter' => '/',
                'filter_value'  => '=',
                'value_value'   => ',',
            ],
            'export'   => [
                'header_local_column' => '|',
            ],
        ],

        'filters' => [
            'count_for_noindex'      => [
                'filter' => 1,
                'value'  => 1,
            ],
            'default_toolbar_sort'   => 'popular',
            'products_count_on_page' => [20, 40, 60],
        ],

        'price_format'   => [
            'decimals'           => 1,
            'decimal_point'      => '.',
            'thousand_seperator' => ' ',
        ],
        // use modifications as a different products, with its properties, grouped in one product
        'group_products' => true,
        //false - one product, with many values for one filter, true - many products, with one value for one filter
        'google_api'     => [
            'key'       => env('GOOGLE_API_KEY'),
            'maps_zoom' => 16,
        ],

        'np_api_key' => env('NP_API_KEY', false),

        'lp_api_public'  => env('LP_API_PUBLIC', false),
        'lp_api_private' => env('LP_API_PRIVATE', false),
        'lp_api_sandbox' => env('LP_API_SANDBOX', 1),
        'lp_api_version' => env('LP_API_VERSION', 3),

        'pb24_merchant_id' => env('PRIVAT24_MERCHANT_ID', null),
        'pb24_merchant_pass' => env('PRIVAT24_MERCHANT_PASS', null),

        'pb_payparts_id' => env('PRIVAT_PAYPARTS_ID', null),
        'pb_payparts_pass' => env('PRIVAT_PAYPARTS_PASS', null),

        'pb_payparts_credit_months_from' => 2,
        'pb_payparts_credit_months_to' => 5,

        'pp_api_client_id' => env('PAYPAL_CLIENT_ID', ''),
        'pp_api_secret'    => env('PAYPAL_SECRET', ''),
        'pp_api_settings'  => [
            'mode'                   => env('PAYPAL_MODE', 'sandbox'),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled'         => true,
            'log.FileName'           => storage_path() . '/logs/paypal.log',
            'log.LogLevel'           => 'ERROR',
        ],

        'backend_uri'      => env('BACKEND_URI', 'back'),
        'settings_exclude' => ['locales', 'backups', 'subscribers'],
        'default_currency' => 'грн',
        'mail_delay'       => 10, // mail delay in seconds

        'cache_control' => [
            'lifetime' => 86400,
            'expires' => 1440 // minutes
        ],
    ];
