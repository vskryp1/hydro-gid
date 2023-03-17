<?php

    namespace App\Notifications;

    use App\Models\Client\Client;
    use App\Models\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    /**
     * Class NewClientAdminEmail
     *
     * @package App\Notifications
     */
    class NewClientAdminEmail extends Notification implements ShouldQueue
    {
        use Queueable;

        /**
         * @var \App\Models\Client\Client
         */
        private $client;

        /**
         * @var \App\Models\User
         */
        private $user;

        /**
         * NewOrderEmail constructor.
         *
         * @param  \App\Models\User          $user
         * @param  \App\Models\Client\Client $client
         */
        public function __construct(User $user, Client $client)
        {
            $this->client = $client;
            $this->user   = $user;
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
            $user   = $this->user;

            return (new MailMessage)->subject(__('mails.user_verification'))->view('frontend.mails.authorization.admin', compact('client', 'user'));
        }
    }
