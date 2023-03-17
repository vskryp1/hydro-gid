<?php

    namespace App\Notifications;

    use App\Models\Client\Client;
    use Illuminate\Notifications\Notification;
    use Illuminate\Support\Facades\Lang;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Auth\Notifications\ResetPassword;

    class ResetPasswordEmail extends Notification
    {
        /**
         * The password reset token.
         *
         * @var string
         */
        public $token;

        /**
         * The object of Client.
         *
         * @var object
         */
        public $client;

        /**
         * The callback that should be used to build the mail message.
         *
         * @var \Closure|null
         */
        public static $toMailCallback;

        /**
         * Create a notification instance.
         *
         * @param \App\Models\Client\Client $client
         * @param                           $token
         */
        public function __construct(Client $client,$token)
        {
            $this->client = $client;
            $this->token = $token;
        }

        /**
         * Get the notification's channels.
         *
         * @param  mixed  $notifiable
         * @return array|string
         */
        public function via($notifiable)
        {
            return ['mail'];
        }

        /**
         * @param $notifiable
         *
         * @return \Illuminate\Notifications\Messages\MailMessage|mixed
         */
        public function toMail($notifiable)
        {
            $client = $this->client;
            $token  = $this->token;

            return (new MailMessage)
                ->subject(__('auth.reset'))
                ->view('frontend.mails.authorization.recovery_password', compact('client', 'token'));
        }

        /**
         * Set a callback that should be used when building the notification mail message.
         *
         * @param  \Closure  $callback
         * @return void
         */
        public static function toMailUsing($callback)
        {
            static::$toMailCallback = $callback;
        }
    }