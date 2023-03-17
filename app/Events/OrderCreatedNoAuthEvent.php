<?php

    namespace App\Events;

    use App\Models\Client\Temp_Client_Orders;
    use App\Models\Order\Order;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Broadcasting\InteractsWithSockets;

    class OrderCreatedNoAuthEvent
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        /**
         * @var Temp_Client_Orders
         */
        public $user;

        /**
         * @var Order
         */
        public $order;

        /**
         * OrderWasCreatedEvent constructor.
         *
         * @param \App\Models\Client\Temp_Client_Orders $user
         * @param \App\Models\Order\Order               $order
         */
        public function __construct(Temp_Client_Orders $user, Order $order)
        {
            $this->user  = $user;
            $this->order = $order;
        }
    }
