<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChangeUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Log::info('Start ChangeUrlSeeder');
	    DB::table('product_translations')->orderBy('id')->chunk(100, function($products) {
		    foreach ($products as $key => $product) {
	            if(stripos($product->description, 'st.hydro-gid.myapp.com.ua')){
				    $changedDescription = str_replace("st.hydro-gid.myapp.com.ua", "skr-hydraulic.com.ua", $product->description);
				    DB::table('product_translations')
				        ->where('id', $product->id)
				        ->update(['description' => $changedDescription]);
			    }
		    }
	    });
    }
}
