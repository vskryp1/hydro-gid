<?php

    namespace App\Listeners;

    use App\Events\OrderCreatedNoAuthEvent;
    use App\Notifications\NewOrderNoAuthClientEmail;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Notification;

    /**
     * Class SendNewOrderWasCreatedNotification
     *
     * @package App\Listeners
     */
    class NewOrderNoAuthClientNotification
    {
        /**
         * Handle the event.
         *
         * @param OrderCreatedNoAuthEvent $event
         *
         * @return void
         */
        public function handle(OrderCreatedNoAuthEvent $event): void
        {
            Log::info('send msg for Client'.$event->user);
            Notification::send($event->user, new NewOrderNoAuthClientEmail($event->user, $event->order));
        }
    }
