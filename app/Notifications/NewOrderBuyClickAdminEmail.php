<?php

    namespace App\Notifications;

    use App\Models\Order\OneClickOrders;
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
    class NewOrderBuyClickAdminEmail extends Notification implements ShouldQueue
    {
        use Queueable;


        /**
         * @var \App\Models\Order\OneClickOrders
         */
        public $clickOrders;

        /**
         * NewOrderEmail constructor.
         *
         * @param \App\Models\Order\OneClickOrders $clickOrders
         */
        public function __construct(OneClickOrders $clickOrders)
        {
            $this->clickOrders = $clickOrders;
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
            $orderBuyClick = $this->clickOrders;

            return (new MailMessage)->subject(__('mails.new_order_one_click'))->view('frontend.mails.order.orderBuyClickAdmin', compact('orderBuyClick'));
        }
    }
