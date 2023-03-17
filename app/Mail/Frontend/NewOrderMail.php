<?php

    namespace App\Mail\Frontend;

    use App\Models\Client\Client;
    use App\Models\Order\Order;
    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Contracts\Queue\ShouldQueue;

    class NewOrderMail extends Mailable implements ShouldQueue
    {
        use Queueable, SerializesModels;

        /**
         * @var Client
         */
        public $client;

        /**
         * @var Order
         */
        public $order;

        /**
         * NewOrderMail constructor.
         *
         * @param Client $client
         * @param Order  $order
         */
        public function __construct(Client $client, Order $order)
        {
            $this->client = $client;
            $this->order  = $order;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
        {
            return $this->view('frontend.mails.orders.index')->subject(__('mails.subject_new_order'));
        }
    }
