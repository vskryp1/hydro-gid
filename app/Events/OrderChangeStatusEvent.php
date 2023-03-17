<?php

    namespace App\Events;

    use App\Models\Client\Client;
    use App\Models\Order\Order;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    /**
     * Class OrderChangeStatusEvent
     *
     * @package App\Events
     */
    class OrderChangeStatusEvent
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        /**
         * @var Client
         */
        public $user;

        /**
         * @var Order
         */
        public $order;

        /**
         * OrderWasCreatedEvent constructor.
         *
         * @param  \App\Models\Client\Client  $user
         * @param  \App\Models\Order\Order    $order
         */
        public function __construct(Client $user, Order $order)
        {
            $this->user    = $user;
            $this->order   = $order;
        }
    }
