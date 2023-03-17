<?php

    namespace App\Jobs;

    use App\Helpers\MailHelper;
    use App\Models\MailTemplate;
    use Illuminate\Bus\Queueable;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;

    class StartNewsLetter implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $_subscribers;
        protected $_template;
        /**
         * Create a new job instance.
         *
         * @return void
         */
        public function __construct(Collection $subscribers, MailTemplate $template)
        {
            $this->_subscribers = $subscribers;
            $this->_template    = $template;
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle()
        {
            foreach($this->_subscribers as $subscriber) {
                MailHelper::sendEmail($this->_template, $subscriber);
                $this->_template->increment('current');
            }
        }
    }
