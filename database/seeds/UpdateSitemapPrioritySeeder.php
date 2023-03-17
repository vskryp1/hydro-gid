<?php

use App\Models\Page\Page;
use App\Models\Seo\Sitemap;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UpdateSitemapPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Log::info('UpdateSitemapPrioritySeeder START');
        Sitemap::wherePriority(0)->get()->map(function($item){
	        //seo 3.0 requirements
	        $priority = 0.5;

	        if ($item->model == Page::class && $item->alias == '/') {
		        $priority = 1;
	        }

	        if ($item->model == Page::class && $item->model::find($item->model_id)->page_template->is_category) {
		        $priority = 0.8;
	        }

	        if ($item->model == Product::class) {
		        $priority = 0.6;
	        }

	        if ($item->model == SeoMetas::class) {
		        $priority = 0.9;
	        }
	        $item->update(['priority' => $priority]);
	        Log::info('UpdateSitemapPrioritySeeder FINISH');
        });
    }
}
