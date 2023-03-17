<?php

    namespace App\Providers;

    use App\Events\ChangeCurrencyCourseEvent;
    use App\Events\NewClientCallbackEvent;
    use App\Events\OrderBuyClickEvent;
    use App\Events\OrderChangeStatusEvent;
    use App\Events\OrderCreatedEvent;
    use App\Events\OrderCreatedNoAuthEvent;
    use App\Events\RegistrationUserEvent;
    use App\Events\ResetPasswordEvent;
    use App\Events\UrlWasBorn;
    use App\Listeners\ChangeCurrencyCourseListener;
    use App\Listeners\ChangeOrderStatusNotification;
    use App\Listeners\NewClientAdminNotification;
    use App\Listeners\NewClientCallbackNotification;
    use App\Listeners\NewOrderAdminNotification;
    use App\Listeners\NewOrderBuyClickNotification;
    use App\Listeners\NewOrderClientNotification;
    use App\Listeners\NewOrderNoAuthAdminNotification;
    use App\Listeners\NewOrderNoAuthClientNotification;
    use App\Listeners\RegisterSitemap;
    use App\Listeners\ResetPasswordNotification;
    use App\Listeners\SendEmailNotification;
    use App\Listeners\SitemapGenerate;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
    use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

    class EventServiceProvider extends ServiceProvider
    {
        protected $listen = [
            UrlWasBorn::class                => [
                RegisterSitemap::class,
                SitemapGenerate::class,
            ],
            ChangeCurrencyCourseEvent::class => [
                ChangeCurrencyCourseListener::class,
            ],
            Registered::class                => [
                SendEmailNotification::class,
                NewClientAdminNotification::class,
            ],
            OrderCreatedEvent::class              => [
                NewOrderClientNotification::class,
                NewOrderAdminNotification::class,
            ],
            NewClientCallbackEvent::class              => [
                NewClientCallbackNotification::class,
            ],
            OrderChangeStatusEvent::class              => [
                ChangeOrderStatusNotification::class,
            ],
            ResetPasswordEvent::class => [
                ResetPasswordNotification::class
            ],
            OrderCreatedNoAuthEvent::class => [
                NewOrderNoAuthClientNotification::class,
                NewOrderNoAuthAdminNotification::class,
            ],
            OrderBuyClickEvent::class => [
                NewOrderBuyClickNotification::class,
            ],
        ];

        public function boot()
        {
            parent::boot();
        }
    }
