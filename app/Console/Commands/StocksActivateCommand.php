<?php

namespace App\Console\Commands;

use App\Jobs\CalculateStockPriceJob;
use App\Models\Stock\Stock;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StocksActivateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:activate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Active stock which started';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	Log::info('start stocks:activate');
        Stock::onlyActive()->goinOn()->get()->each(function ($stock){
            dispatch(new CalculateStockPriceJob($stock));
        });
	    Log::info('complete stocks:activate');
    }
}
