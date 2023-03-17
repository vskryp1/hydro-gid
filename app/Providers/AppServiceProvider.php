<?php

    namespace App\Providers;

    use App\Models\Client\Client;
    use App\Models\Order\Order;
    use App\Models\Order\ServiceOrder;
    use App\Models\Product\Product;
    use App\Models\Stock\Stock;
    use App\Observers\ClientObserver;
    use App\Observers\OrderObserver;
    use App\Observers\ProductObserver;
    use App\Observers\ServiceObserver;
    use App\Observers\StockObserver;
    use App\Singletons\BreadcrumbsData;
    use App\Singletons\OgMetaData;
    use App\Singletons\PageData;
    use App\Singletons\SchemaOrgData;
    use App\Singletons\SeoMetaData;
    use App\Singletons\SeoPaginateData;
    use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
    use Blade;
    use File;
    use Illuminate\Support\ServiceProvider;
    use Laravel\Dusk\DuskServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        public function boot()
        {
            // TODO придумать лучшее место для всего этого
            Blade::directive('version', function() {
                return File::get(base_path('version'));
            });

            Client::observe(ClientObserver::class);
            Product::observe(ProductObserver::class);
            Stock::observe(StockObserver::class);
            ServiceOrder::observe(ServiceObserver::class);
            Order::observe(OrderObserver::class);
        }

        public function register()
        {
            if ($this->app->environment() === 'local') {
                $this->app->register(IdeHelperServiceProvider::class);
                $this->app->register(DuskServiceProvider::class);
            }

            $this->app->singleton(SeoMetaData::class, function() {
                return new SeoMetaData;
            });
            $this->app->singleton(PageData::class, function() {
                return new PageData;
            });
            $this->app->singleton(OgMetaData::class, function() {
                return new OgMetaData;
            });
            $this->app->singleton(BreadcrumbsData::class, function() {
                return new BreadcrumbsData;
            });
            $this->app->singleton(SchemaOrgData::class, function() {
                return new SchemaOrgData;
            });
            $this->app->singleton(SeoPaginateData::class, function() {
                return new SeoPaginateData;
            });

            if (request()->is('*' . env('BACKEND_URI') . '*')) {
                config(['jsvalidation.view' => 'jsvalidation::bootstrapCustom']);
            }
        }
    }
