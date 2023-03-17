<?php

    namespace App\Listeners;

    use App\Helpers\ShopHelper;
    use App\Notifications\NewClientAdminEmail;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Support\Facades\Notification;

    /**
     * Class NewClientAdminNotification
     *
     * @package App\Listeners
     */
    class NewClientAdminNotification
    {

        /**
         * Handle the event.
         *
         * @param  Registered  $event
         *
         * @return void
         */
        public function handle(Registered $event): void
        {
            $admins = ShopHelper::feedback_emails();
            if (count($admins)) {
                foreach ($admins as $admin) {
                    if ($admin) {
                        Notification::send($admin, (new NewClientAdminEmail($admin, $event->user)));
                    }
                }
            }
        }
    }
