<?php

    namespace App\Listeners;

    use App\Events\UrlWasBorn;
    use App\Models\Page\Page;
    use App\Models\Product\Product;
    use App\Models\Seo\SeoMetas;
    use App\Models\Seo\Sitemap;
    use Carbon\Carbon;

    class RegisterSitemap
    {
        public function handle(UrlWasBorn $event)
        {
            //seo 3.0 requirements
            $priority = 0.5;

            if ($event->model->getMorphClass() == Page::class && $event->model->getOriginal('alias') == '/') {
                $priority = 1;
            }

            if ($event->model->getMorphClass() == Page::class && $event->model->page_template->is_category) {
                $priority = 0.8;
            }

            if ($event->model->getMorphClass() == Product::class) {
                $priority = 0.6;
            }

            if ($event->model->getMorphClass() == SeoMetas::class) {
                $priority = 0.9;
            }

            $alias = str_replace(env('APP_URL') . '/', '', $event->model->alias);

            Sitemap::whereAlias($alias)->delete();
            Sitemap::updateOrCreate([
                'model_id' => $event->model->id,
                'model'    => $event->model->getMorphClass(),
            ], [
                'alias'      => $alias,
                'priority'   => $priority,
                'is_active'  => isset($event->model->use_sitemap) ? $event->model->use_sitemap && $event->model->active : $event->model->active,
                'changefreq' => Sitemap::DEFAULT_FREQ,
                'lasmod'     => Carbon::parse($event->model->updated_at)->toDateString(),
            ]);
        }
    }
