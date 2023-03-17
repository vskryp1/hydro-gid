<?php

    namespace App\Events;

    use App\Models\Client\Client;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    /**
     * Class PasswordRecoverEvent
     *
     * @package App\Events
     */
    class ResetPasswordEvent
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        /**
         * @var Client
         */
        public $user;

        /**
         * OrderWasCreatedEvent constructor.
         *
         * @param  \App\Models\Client\Client  $user
         */
        public function __construct(Client $user)
        {
            $this->user    = $user;
        }
    }
