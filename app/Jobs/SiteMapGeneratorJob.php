<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Helpers\ShopHelper;
use App\Models\Seo\Sitemap;
use Illuminate\Support\Facades\Log;
use Storage;

class SiteMapGeneratorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pages = Sitemap::onlyActive()->byPosition()
            ->get(['alias', 'model', 'model_id', 'lastmod', 'priority', 'changefreq'])
            ->toArray();
        $sitemap = '';
        foreach ($pages as $page) {
            foreach (ShopHelper::setting('locales', [], false) as $lang => $language) {
                $page = array_merge($page, ['locale' => $lang]);
                try {
                    $robots = $page['model']::find($page['model_id'])->translate($lang)->seo_robots;
                    if (!(stristr($robots, 'noindex') && stristr($robots, 'follow'))) {
                        $sitemap .= view('backend.seo-sitemap.url', $page)->render();
                    }
                } catch (\Exception $e) {
                    Log::error('SiteMapGeneratorJob ERROR: ', [$page['model_id'], $lang, $e->getMessage()]);
                }
            }
        }
        Storage::disk('public')
            ->put('sitemap.xml', '<?xml version="1.0" encoding="UTF-8"?>' .
                view('backend.seo-sitemap.sitemap', [
                    'sitemap' => $sitemap,
                    'locale' => config('app.locale', 'ru'),
                ])->render());
    }
}
