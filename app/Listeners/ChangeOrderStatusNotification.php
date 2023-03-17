<?php

    namespace App\Listeners;

    use App\Events\OrderChangeStatusEvent;
    use App\Events\OrderCreatedEvent;
    use App\Notifications\ChangeOrderStatusEmail;
    use Illuminate\Support\Facades\Notification;

    /**
     * Class ChangeOrderStatusNotification
     *
     * @package App\Listeners
     */
    class ChangeOrderStatusNotification
    {
        /**
         * Handle the event.
         *
         * @param  OrderCreatedEvent  $event
         *
         * @return void
         */
        public function handle(OrderChangeStatusEvent $event): void
        {
            if(request()->has('ttn') || request()->has('notification')){
                Notification::send($event->user, new ChangeOrderStatusEmail($event->user, $event->order));
            }

        }
    }
