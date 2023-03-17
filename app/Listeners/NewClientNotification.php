<?php

    namespace App\Listeners;

    use App\Notifications\NewClientEmail;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Support\Facades\Notification;
    use Illuminate\Contracts\Queue\ShouldQueue;

    /**
     * Class NewClientNotification
     *
     * @package App\Listeners
     */
    class NewClientNotification
    {
        /**
         * Handle the event.
         *
         * @param  Registered $event
         *
         * @return void
         */
        public function handle(Registered $event): void
        {
            Notification::send($event->user, new NewClientEmail($event->user));
        }
    }
