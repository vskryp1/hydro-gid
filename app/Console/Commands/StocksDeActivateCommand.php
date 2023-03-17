<?php

namespace App\Console\Commands;

use App\Jobs\RevertStockPricesJob;
use App\Models\Stock\Stock;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StocksDeActivateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:deactivate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate stock which expired';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	Log::info('start stocks:deactivate');
        $now = Carbon::now();
        Stock::onlyActive()->whereDate('expiration_date', $now->subDay())->get()->each(function ($stock){
            dispatch(new RevertStockPricesJob($stock, $stock->products));
        });
	    Log::info('complete stocks:deactivate');
    }
}
