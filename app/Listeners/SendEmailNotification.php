<?php

    namespace App\Listeners;

    use App\Models\Client;
    use App\Events\RegistrationUserEvent;
    use App\Notifications\ResetPasswordEmail;
    use App\Notifications\VerifyEmail;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Support\Facades\Notification;

    class SendEmailNotification
    {
        /**
         * Handle the event.
         *
         * @param \Illuminate\Auth\Events\Registered $event
         *
         * @return void
         */
        public function handle(Registered $event)
        {
            if ($event->user instanceof MustVerifyEmail && !$event->user->hasVerifiedEmail()) {
                Notification::send($event->user, new VerifyEmail($event->user));
            }
        }
    }
