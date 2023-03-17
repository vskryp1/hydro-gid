<?php

    namespace App\Events;

    use Illuminate\Queue\SerializesModels;
    use Illuminate\Broadcasting\PrivateChannel;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Broadcasting\InteractsWithSockets;

    class ChangeCurrencyCourseEvent
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        public function broadcastOn()
        {
            return new PrivateChannel('channel-name');
        }
    }
