<?php

namespace App\Jobs;

use App\Models\Client\Client;
use App\Models\Product\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ChangeProductStatusEmail;

class ChangeProductStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $product;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Client::chunk(100, function($clients)
        {
            $clients->map(function($user) {
                $stored = DB::table('carts')
                    ->where('identifier', 'waitinglist.' . $user->id)
                    ->first();
                if(!$stored) {
                    return false;
                }
                $waitinglist = unserialize($stored->content);

                if($waitinglist->contains('id', $this->product->id))
                {
                    Notification::send($user, new ChangeProductStatusEmail($user, $this->product));
                }
            });
        });
    }
}
