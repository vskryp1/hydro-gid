<?php

    namespace App\Jobs;

    use App\Models\MailTemplate;
    use App\Models\Subscriber;
    use Carbon\Carbon;
    use Illuminate\Bus\Queueable;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;

    class ChunkNewsLetter implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $_sendAt;
        protected $_subscribers;
        protected $_template;
        /**
         * Create a new job instance.
         *
         * @return void
         */
        public function __construct(Collection $subscribers, Carbon $sendAt, MailTemplate $template)
        {
            $this->_subscribers = $subscribers;
            $this->_sendAt      = $sendAt;
            $this->_template    = $template;
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle()
        {
            $delay = \Setting::get('subscribers.timeout', 0);
            Subscriber::chunk(\Setting::get('subscribers.mail_count', 100), function (Collection $subscribers) use ($delay) {
                if ($delay > 0) {
                    dispatch(new StartNewsLetter($subscribers, $this->_template))->delay($this->_sendAt->addMinutes($delay));
                } else {
                    dispatch(new StartNewsLetter($subscribers, $this->_template));
                }
            });

        }
    }
