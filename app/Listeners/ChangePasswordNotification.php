<?php

    namespace App\Listeners;

    use App\Events\ChangePasswordEvent;
    use App\Notifications\ChangePasswordEmail;
    use Illuminate\Support\Facades\Notification;

    /**
     * Class ChangePasswordNotification
     *
     * @package App\Listeners
     */
    class ChangePasswordNotification
    {
        /**
         * Handle the event.
         *
         * @param  ChangePasswordEvent  $event
         *
         * @return void
         */
        public function handle(ChangePasswordEvent $event): void
        {
            Notification::send($event->user, new ChangePasswordEmail($event->user));
        }
    }
