<?php

    namespace App\Events;

    use App\Models\Client\Client;
    use App\Models\Order\Order;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    /**
     * Class ChangePasswordEvent
     *
     * @package App\Events
     */
    class ChangePasswordEvent
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        /**
         * @var Client
         */
        public $user;

        /**
         * ChangePasswordEvent constructor.
         *
         * @param  \App\Models\Client\Client  $user
         */
        public function __construct(Client $user)
        {
            $this->user    = $user;
        }
    }
