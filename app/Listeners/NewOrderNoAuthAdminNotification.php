<?php

    namespace App\Listeners;

    use App\Events\OrderCreatedNoAuthEvent;
    use App\Helpers\ShopHelper;
    use App\Notifications\NewOrderNoAuthClientAdminEmail;
    use Illuminate\Support\Facades\Notification;

    class NewOrderNoAuthAdminNotification
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
            $admins = ShopHelper::feedback_emails();
            if (count($admins)) {
                foreach ($admins as $admin) {
                    if ($admin) {
                        Notification::send($admin, new NewOrderNoAuthClientAdminEmail($event->user, $event->order));
                    }
                }
            }
        }
    }
