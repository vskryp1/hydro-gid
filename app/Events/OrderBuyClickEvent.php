<?php

namespace App\Events;

use App\Models\Order\OneClickOrders;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class OrderBuyClickEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Order\OneClickOrders
     */
    public $clickOrders;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Order\OneClickOrders $clickOrders
     */
    public function __construct(OneClickOrders $clickOrders)
    {
        $this->clickOrders = $clickOrders;
    }
}
