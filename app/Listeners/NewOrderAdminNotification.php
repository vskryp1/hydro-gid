<?php

    namespace App\Listeners;

    use App\Events\OrderCreatedEvent;
    use App\Helpers\ShopHelper;
    use App\Notifications\NewOrderAdminEmail;
    use Illuminate\Support\Facades\Notification;

    /**
     * Class SendNewOrderWasCreatedNotification
     *
     * @package App\Listeners
     */
    class NewOrderAdminNotification
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
            $admins = ShopHelper::feedback_emails();
            if (count($admins)) {
                foreach ($admins as $admin) {
                    if ($admin) {
                        Notification::send($admin, new NewOrderAdminEmail($event->user, $event->order));
                    }
                }
            }
        }
    }
