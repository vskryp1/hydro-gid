<?php

    namespace App\Listeners;

    use App\Events\ResetPasswordEvent;
    use App\Notifications\ResetPasswordEmail;
    use Illuminate\Support\Facades\Notification;

    /**
     * Class PasswordRecoveryNotification
     *
     * @package App\Listeners
     */
    class ResetPasswordNotification
    {
        /**
         * Handle the event.
         *
         * @param ResetPasswordEvent $event
         *
         * @param string             $token
         *
         * @return void
         */
        public function handle(ResetPasswordEvent $event, $token): void
        {
            Notification::send($event->user, new ResetPasswordEmail($event->user, $token));
        }
    }
