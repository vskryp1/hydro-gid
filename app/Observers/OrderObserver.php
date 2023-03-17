<?php

    namespace App\Observers;

    use App\Events\OrderChangeStatusEvent;
    use App\Models\Order\Order;

    class OrderObserver
    {
        public function updated(Order $order)
        {
            if ($order->isDirty('order_status_id')) {
                event(new OrderChangeStatusEvent($order->client, $order));
            }
        }
    }
