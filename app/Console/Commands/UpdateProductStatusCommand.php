<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product\Product;
use Illuminate\Support\Carbon;
use App\Enums\ProductAvailability;
use Illuminate\Support\Facades\Log;

class UpdateProductStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update product status from EXPECTED_DELIVERY to AVAILABLE, after the expected date';

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
    	Log::info('startProductStatusUpdate');
	    $complete = Product::where([['availability', '=', ProductAvailability::EXPECTED_DELIVERY],
                        ['expected_at', '<=', Carbon::now()->format(config('app.formats.php.date'))]])
		    ->update(['availability' => ProductAvailability::AVAILABLE,
			          'expected_at'  => NULL]);
	    Log::info('completeProductStatusUpdate', [$complete]);
    }
}
