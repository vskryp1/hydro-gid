<?php

    namespace App\Events;

    use App\Models\Client\Client;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Broadcasting\InteractsWithSockets;

    class RegistrationUserEvent
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        /**
         * @var \App\Models\Client\Client
         */
        public $user;

        /**
         * Create a new event instance.
         *
         * @param \App\Models\Client\Client $user
         */
        public function __construct(Client $user)
        {
            $this->user = $user;
        }


    }
