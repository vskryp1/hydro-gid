<?php

    namespace App\Notifications;

    use App\Models\Client\Client;
    use App\Models\Product\Product;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    /**
     * Class ChangeOrderStatusEmail
     *
     * @package App\Notifications
     */
    class ChangeProductStatusEmail extends Notification implements ShouldQueue
    {
        use Queueable;

        /**
         * @var \App\Models\Client\Client
         */
        private $user;

        /**
         * @var \App\Models\Order\Order
         */
        private $product;

        /**
         * ChangeProductStatusEmail constructor.
         *
         * @param  \App\Models\Client\Client  $user
         * @param  \App\Models\Product\Product    $product
         */
        public function __construct(Client $user, Product $product)
        {
            $this->user    = $user;
            $this->product   = $product;
            $this->queue   = config('queue.mail_queue_name');
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param  mixed  $notifiable
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
         * @param  mixed  $notifiable
         *
         * @return \Illuminate\Notifications\Messages\MailMessage
         */
        public function toMail($notifiable)
        {
            $user    = $this->user;
            $product = $this->product;

            return (new MailMessage)->subject(__('mails.product_status_mail_title'))
                ->view('frontend.mails.product.change_status', compact('user', 'product'));
        }
    }
