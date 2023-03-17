<?php

    namespace App\Listeners;

    use App\Events\UrlWasBorn;
    use App\Jobs\SiteMapGeneratorJob;
    use Artisan;

    class SitemapGenerate
    {
        public function handle(UrlWasBorn $event)
        {
            dispatch(new SiteMapGeneratorJob());
        }
    }
