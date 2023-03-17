<?php

    namespace App\Notifications;

    use App\Helpers\OrderHelper;
    use App\Http\Controllers\Backend\Orders\OrderController;
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
    class NewOrderClientEmail extends Notification implements ShouldQueue
    {
        use Queueable;

        /**
         * @var \App\Models\Client\Client
         */
        private $user;

        /**
         * @var \App\Models\Order\Order
         */
        private $order;

        /**
         * NewOrderEmail constructor.
         *
         * @param \App\Models\Client\Client $user
         * @param \App\Models\Order\Order   $order
         */
        public function __construct(Client $user, Order $order)
        {
            $this->user  = $user;
            $this->order = $order;
            $this->queue = config('queue.mail_queue_name');
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param mixed $notifiable
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
         * @param mixed $notifiable
         *
         * @return \Illuminate\Notifications\Messages\MailMessage
         */
        public function toMail($notifiable)
        {
            $user  = $this->user;
            $order = $this->order;
            $warehouse = OrderHelper::getWarehouse($order);

            return (new MailMessage)->subject(__('mails.new_order_created'))->view('frontend.mails.order.index', compact('user', 'order', 'warehouse'));
        }
    }
