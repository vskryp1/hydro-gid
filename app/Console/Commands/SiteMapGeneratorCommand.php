<?php

    namespace App\Console\Commands;

    use App\Helpers\ShopHelper;
    use App\Models\Seo\Sitemap;
    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\Log;
    use Storage;

    class SiteMapGeneratorCommand extends Command
    {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'sitemap';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Generate sitemap.xml file';

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
         * @throws \Throwable
         */
        public function handle()
        {
            $entities = [];
            $pages    = Sitemap::onlyActive()->byPosition()
                ->get(['alias', 'model', 'model_id', 'lastmod', 'priority', 'changefreq'])
                ->toArray();
            $sitemap  = '';
            $bar      = $this->output->createProgressBar(count($pages));

            $bar->start();
            foreach ($pages as $page) {
                foreach (ShopHelper::setting('locales', [], false) as $lang => $language) {
                    $page    = array_merge($page, ['locale' => $lang]);
                    try{
                        $robots = $page['model']::find($page['model_id'])->translate($lang)->seo_robots;
                        if(!(stristr($robots, 'noindex') && stristr($robots, 'follow')))
                        {
                            $sitemap .= view('backend.seo-sitemap.url', $page)->render();
                        }
                    } catch (\Exception $e){
                        Log::error('SiteMapGenerator ERROR: ', [$page['model_id'], $lang, $e->getMessage()]);
                    }
                }
                $bar->advance();
            }
            $bar->finish();
            $this->info("\n");
            Storage::disk('public_files')
                ->put('sitemap.xml', '<?xml version="1.0" encoding="UTF-8"?>' .
                    view('backend.seo-sitemap.sitemap', [
                        'sitemap' => $sitemap,
                        'locale'  => config('app.locale', 'ru'),
                    ])->render());

        }
    }
