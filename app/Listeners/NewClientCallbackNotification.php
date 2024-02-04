<?php

    namespace App\Listeners;

    use App\Events\NewClientCallbackEvent;
    use App\Helpers\ShopHelper;
    use App\Notifications\NewClientCallbackEmail;
    use Illuminate\Support\Facades\Notification;
    use Illuminate\Support\Facades\Mail;

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
                        Mail::send(['html' => 'frontend.mails.client_request.index'], ['user' => $admin, 'serviceOrder' => $event->serviceOrder],
                function ($message) use ($admin) {
                   $message->to($admin->email)
                   ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                   ->subject(env('MAIL_FROM_NAME'));
      });
                        //Notification::sendNow($admin, (new NewClientCallbackEmail($admin, $event->serviceOrder)));
                    }
                }
            }
        }
    }
