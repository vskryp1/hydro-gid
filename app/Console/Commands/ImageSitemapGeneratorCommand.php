<?php

namespace App\Console\Commands;

use App\Helpers\ShopHelper;
use App\Models\Page\Page;
use App\Models\Product\Product;
use App\Models\Sliders\Slider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Storage;

class ImageSitemapGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap-images.xml file';

    public $models = [
        Page::class => 'Pages',
        Product::class => 'Products',
        Slider::class => 'Sliders'
    ];

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
        $aliases = [];
        $sitemap  = '';
        foreach ($this->models as $model => $name) {
            $model::onlyActive()
                ->whereNotNull('alias')
                ->without('translations')
                ->chunk(100, function ($pages) use($model, &$aliases, &$i, &$sitemap) {
                    foreach ($pages as $page) {
                        foreach (ShopHelper::setting('locales', [], false) as $lang => $language) {
                            try{
                                $robots = $page->translate($lang)->seo_robots;
                                if(!(stristr($robots, 'noindex') && stristr($robots, 'follow')))
                                {
                                    switch ($model)
                                    {
                                        case Page::class:
                                            $img = $page->additional_field_values()
                                                ->whereHas('additional_field', function($q) {
                                                    $q->where('key', 'LIKE', "%image%");
                                                })->first();
                                            $page->image = asset("/storage/pages/$page->id/" . $img->value);
                                            break;
                                    }
                                    $sitemap .= view('backend.seo-sitemap-image.url', compact('page', 'lang', 'model'))->render();
                                }
                            } catch (\Exception $e){
                                Log::error('ImageSitemapGenerator ERROR: ', [$page['model_id'], $lang, $e->getMessage()]);
                            }
                        }
                    }
                });
        }
        Storage::disk('public')
            ->put('sitemap-image.xml', '<?xml version="1.0" encoding="UTF-8"?>' .
                view('backend.seo-sitemap-image.sitemap-image', [
                    'sitemap' => $sitemap,
                    'locale'  => config('app.locale', 'ru'),
                ])->render());
    }
}
