<?php

    namespace App\Notifications;

    use App\Models\Client\Client;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    /**
     * Class ChangePasswordEmail
     *
     * @package App\Notifications
     */
    class ChangePasswordEmail extends Notification implements ShouldQueue
    {
        use Queueable;

        /**
         * @var \App\Models\Client\Client
         */
        private $client;

        /**
         * NewOrderEmail constructor.
         *
         * @param  \App\Models\Client\Client $client
         */
        public function __construct(Client $client)
        {
            $this->client = $client;
            $this->queue  = config('queue.mail_queue_name');
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param  mixed $notifiable
         *
         * @return array
         */
        public function via($notifiable)
        {
            return ['mail'];
        }

        /**
         * Get the mail representation of the notification.
         *
         * @param  mixed $notifiable
         *
         * @return \Illuminate\Notifications\Messages\MailMessage
         */
        public function toMail($notifiable)
        {
            $client = $this->client;

            return (new MailMessage)->subject(__('mails.change_password_email'))
                ->view('frontend.mails.authorization.new_password', compact('client'));
        }
    }
