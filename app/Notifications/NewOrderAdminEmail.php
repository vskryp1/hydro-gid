<?php

    namespace App\Notifications;

    use App\Helpers\OrderHelper;
    use App\Models\Client\Client;
    use App\Models\Order\Order;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;
    use Illuminate\Support\Arr;

    /**
     * Class NewOrderEmail
     *
     * @package App\Notifications
     */
    class NewOrderAdminEmail extends Notification implements ShouldQueue
    {
        use Queueable;

        /**
         * @var \App\Models\Client\Client
         */
        private $client;

        /**
         * @var \App\Models\Order\Order
         */
        private $order;

        /**
         * NewOrderEmail constructor.
         *
         * @param  \App\Models\Client\Client  $client
         * @param  \App\Models\Order\Order $order
         */
        public function __construct(Client $client, Order $order)
        {
            $this->client = $client;
            $this->order  = $order;
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
            $order  = $this->order;
            $client = $this->client;
            $warehouse = OrderHelper::getWarehouse($order);

            return (new MailMessage)->subject(__('mails.new_order_created'))->view('frontend.mails.order.manager', compact('order', 'client', 'warehouse'));
        }
    }
