<?php

    namespace App\Console\Commands;

    use App\Events\ChangeCurrencyCourseEvent;
    use App\Models\Currency\Currency;
    use Illuminate\Console\Command;
    use OceanApplications\currencylayer;

    class CurrenciesCommand extends Command
    {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'currencies:course';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Get course from currencylayer.com';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle()
        {
            $api_key = config('app.currencylayer_api_key');
            if ($api_key) {
                //Get default and other active currencies
                $currency_default = Currency::onlyActive()->orderBy('default', 'desc')->first();
                $currencies       = Currency::onlyActive()->where('code', '<>', $currency_default->code)->get();
                if ($currencies && $currency_default) {
                    //Get actual courses from currencylayer
                    $currencylayer = new currencylayer\client($api_key);
                    $courses       = $currencylayer->source($currency_default->code)
                        ->currencies(implode(',', $currencies->pluck('code')->toArray()))
                        ->live();

                    //Attach course to currencies
                    $currency_default->courses()->create(['course' => 1]);
                    $currencies->each(function($currency) use ($courses) {
                        $course = isset($courses['quotes'][$courses['source'] . $currency->code]) ? $courses['quotes'][$courses['source'] . $currency->code] : 1;
                        $currency->courses()->create(['course' => $course]);
                    });
                    $this->info('All currencies was updated!');

                    event(new ChangeCurrencyCourseEvent());

                    return;
                }
                $this->info('No currencies!');
                return;
            }
            $this->info('No API key!');
        }
    }
