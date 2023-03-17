<?php

    namespace App\Notifications;

    use App\Models\Client\Client;
    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Notification;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Config;
    use Illuminate\Support\Facades\URL;

    class VerifyEmail extends Notification implements ShouldQueue
    {
        use Queueable;

        /**app/Notifications/VerifyEmail.php
         * @var \App\Models\Client\Client
         */
        public $user;

        public $verificationUrl;

        public function __construct(Client $user)
        {
            $this->user            = $user;
            $this->verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                ['id' => $user->getKey()]
            );
            $this->queue = config('queue.mail_queue_name2');
        }

        /**
         * The callback that should be used to build the mail message.
         *
         * @var \Closure|null
         */
        public static $toMailCallback;

        /**
         * Get the notification's channels.
         *
         * @param mixed $notifiable
         *
         * @return array|string
         */
        public function via($notifiable)
        {
            return ['mail'];
        }

        /**
         * Build the mail representation of the notification.
         *
         * @param mixed $notifiable
         *
         * @return \Illuminate\Notifications\Messages\MailMessage
         */
        public function toMail($notifiable)
        {
            $verificationUrl = $this->verificationUrl;
            if (static::$toMailCallback) {
                return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
            }
            $client     = $this->user;
            $actionText = __('auth.verify');

            return (new MailMessage)
                ->subject(__('mails.user_verification'))
                ->view('vendor.notifications.newuser', compact('client', 'verificationUrl', 'actionText'));
        }

        /**
         * Set a callback that should be used when building the notification mail message.
         *
         * @param \Closure $callback
         *
         * @return void
         */
        public static function toMailUsing($callback)
        {
            static::$toMailCallback = $callback;
        }
    }
