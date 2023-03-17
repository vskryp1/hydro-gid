<?php

    namespace App\Helpers;

    use App\Models\Page\Page;
    use Illuminate\Support\Facades\Cache;

    class CategoryHelper
    {
        public static function getAllChildren($page, $children = [])
        {
            $children[$page->id] = $page;

            if (count($page->children) > 0) {
                foreach ($page->children as $child) {
                    $children = self::getAllChildren($child, $children);
                }
            }

            return $children;
        }

        public static function getPageCategories($page)
        {
            return Cache::tags('pages')
                ->remember(
                    'page_categories.' . $page->alias,
                    config('app.cache_minutes'),
                    function() use ($page) {
                        $categories   = array_keys(self::getAllChildren($page));
                        $categories[] = $page->id;

                        return $categories;
                    }
                );
        }

        public static function getChildren($page)
        {
            return Cache::tags('pages')
                ->remember(
                    'page_children.' . $page,
                    config('app.cache_minutes'),
                    function() use ($page) {
                        return Page::productCategories()
                            ->select('id', 'alias')
                            ->where('parent_page_id', $page)
                            ->onlyActive()
                            ->get();
                    }
                );
        }
    }
