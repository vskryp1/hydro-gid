<?php

    namespace App\Listeners;

    use App\Events\NewClientCallbackEvent;
    use App\Helpers\ShopHelper;
    use App\Notifications\NewClientCallbackEmail;
    use Illuminate\Support\Facades\Notification;

    /**
     * Class NewClientCallbackNotification
     *
     * @package App\Listeners
     */
    class NewClientCallbackNotification
    {
        /**
         * Handle the event.
         *
         * @param  NewClientCallbackEvent  $event
         *
         * @return void
         */
        public function handle(NewClientCallbackEvent $event): void
        {
            $admins = ShopHelper::feedback_emails();
            if (count($admins)) {
                foreach ($admins as $admin) {
                    if ($admin) {
                        Notification::send($admin, (new NewClientCallbackEmail($admin, $event->serviceOrder)));
                    }
                }
            }
        }
    }
