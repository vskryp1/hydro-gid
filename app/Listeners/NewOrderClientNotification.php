<?php

    namespace App\Listeners;

    use App\Events\OrderCreatedEvent;
    use App\Notifications\NewOrderClientEmail;
    use Illuminate\Support\Facades\Notification;

    /**
     * Class SendNewOrderWasCreatedNotification
     *
     * @package App\Listeners
     */
    class NewOrderClientNotification
    {
        /**
         * Handle the event.
         *
         * @param  OrderCreatedEvent  $event
         *
         * @return void
         */
        public function handle(OrderCreatedEvent $event): void
        {
            Notification::send($event->user, new NewOrderClientEmail($event->user, $event->order));
        }
    }
