<?php

    namespace App\Jobs;

    use App\Helpers\ShopHelper;
    use Cache;
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;

    class ConvertPriceJob implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $default_currency;
        protected $models;
        protected $fields;
        protected $currency;

        /**
         * ConvertPriceJob constructor.
         *
         * @param      $default_currency
         * @param      $models
         * @param      $fields
         * @param      $currency
         */
        public function __construct($default_currency, $models, $fields, $currency = null)
        {
            $this->default_currency = $default_currency;
            $this->models           = $models;
            $this->fields           = $fields;
            $this->currency         = $currency;
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle()
        {
            foreach ($this->models as $model) {
                foreach ($this->fields as $field) {
                    $model->{$field} = ShopHelper::price_convert($model->{'original_' . $field},
                        (!is_null($this->currency) ? $this->currency : $model->currency), $this->default_currency);
                }
                $model->save();
            }
            Cache::tags('currencies')->flush();
        }
    }