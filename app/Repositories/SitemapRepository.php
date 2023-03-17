<?php
    /**
     * Created by PhpStorm.
     * User: adminko
     * Date: 27.10.18
     * Time: 23:49
     */

    namespace App\Repositories;

    use App;
    use App\Models\Page\Page;
    use App\Models\Product\Product;
    use App\Models\Seo\Sitemap;
    use DB;
    use Illuminate\Http\Request;

    class SitemapRepository
    {
        protected $request;
        public $models = [
            Page::class => 'Pages',
            Product::class => 'Products',
        ];

        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        /**
         * Return all values related to given model in alphabetical order
         *
         * @param $model
         *
         * @return array
         */
        public function getEntities($model)
        {
            $result = [];
            $model::onlyActive()
                ->wherehas('translations', function ($query) {
                    return $query
                        ->where('name', 'like', '%' . request('search') . '%')
                        ->orderBy('name');
                })
                ->get()
                ->sortBy(function ($item) {
                    return $item->name;
                })
                ->map(function ($item) use (&$result) {
                    $result[$item->id] = $item->name;
                });

            return $result;
        }

        /**
         * Generate full site sitemap in database
         *
         * @return int
         */
        public function generate()
        {
            DB::table('sitemap')->truncate();
            $i = 0;
            $aliases = [];
            foreach ($this->models as $model => $name) {
                $pages = $model::onlyActive()->byPosition()
                    ->whereNotNull('alias')
                    ->without('translations')
                    ->get();

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
            }

            return $i;
        }
    }