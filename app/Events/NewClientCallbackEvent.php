<?php

    namespace App\Events;

    use App\Models\Order\ServiceOrder;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    /**
     * Class NewClientCallbackEvent
     *
     * @package App\Events
     */
    class NewClientCallbackEvent
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        /**
         * @var ServiceOrder
         */
        public $serviceOrder;

        /**
         * NewClientCallbackEvent constructor.
         *
         * @param  ServiceOrder                     $serviceOrder
         */
        public function __construct($serviceOrder)
        {
            $this->serviceOrder = $serviceOrder;
        }
    }
