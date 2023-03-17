<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Page\Page;
use App\Models\Product\Product;
use App\Models\Seo\Sitemap;
use DB;

class SitemapRegisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $models = [
        Page::class => 'Pages',
        Product::class => 'Products',
    ];

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('sitemap')->truncate();
        $i = 0;
        $aliases = [];
        foreach ($this->models as $model => $name) {
            $model::onlyActive()->byPosition()
                ->whereNotNull('alias')
                ->without('translations')
                ->chunk(100, function ($pages) use($model, &$aliases, &$i) {
                    foreach ($pages as $page) {
                        //seo 3.0 requirements
                        $priority = 0.5;
                        switch ($model)
                        {
                            case Page::class:
                                $priority = $page->getOriginal('alias') == '/'
                                    ? 1
                                    : ($page->page_template->is_category ? 0.8 : $priority);
                                break;
                            case Product::class:
                                $priority = 0.6;
                                break;
                        }
                        $alias = str_replace(env('APP_URL') . '/', '', $page->alias);
                        if(!in_array($alias, $aliases)) {
                            Sitemap::create([
                                'model'     => $model,
                                'model_id'  => $page->id,
                                'position'  => $i,
                                'priority'   => $priority,
                                'alias'     => $alias,
                                'is_active' => isset($page->use_sitemap) ? $page->use_sitemap : true,
                            ]);
                            $aliases[] = $alias;
                            $i++;
                        }
                    }
                });
        }
    }
}
