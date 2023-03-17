<?php

    namespace App\Helpers;

    use App\Models\Menu\Menu;
    use App\Models\Menu\MenuItem;
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Cache;

    class MenuHelper
    {
        public static function getMenu($alias, $attributes = [])
        {
	        $page_id = $attributes['current_id'] ?? '';
            $cache_name = md5('menu_' . $alias . $page_id . '_' . App::getLocale());
            return Cache::tags(['pages', 'menus'])->remember($cache_name, config('app.cache_minutes'),
                function() use ($alias, $attributes) {
                    $menu = Menu::whereAlias($alias)->first();
                    if ($menu) {
                        switch ($menu->type) {
                            case Menu::MENU_CONSTRUCTOR:
                                if (count($menu->menu_items_parents) > 0) {
                                    $menu_items = self::getMenuItems($menu->menu_items_parents, $attributes);
                                }
                                break;
                            case Menu::MENU_PAGE_PARENT:
                                //get pages by parent
                                if ($menu->page && $menu->page->active) {
                                    $children_active = Cache::tags([
                                        'pages',
                                        'menus',
                                    ])->remember('page.children.' . $menu->page->id, config('app.cache_minutes'),
                                        function() use ($menu) {
                                            return $menu->page->children_active;
                                        });

                                    $menu_items = self::getPageItems($children_active, $attributes);
                                }
                                break;
                        }
                        return self::wrappMenu($menu_items, $attributes);
                    }
                    return '';
                }
            );
        }

        public static function wrappMenu($menu_items, $attributes)
        {
            if (isset($menu_items['html']) && $menu_items['html'] != '') {
                return view('frontend.elements.menu.' . ($attributes['template'] ?? 'default') . '.wrapper',
                    ['items' => $menu_items['html']])->render();
            }
            return '';
        }

        public static function getMenuItems($items, $attributes, $level = 0)
        {
            $html     = '';
            $active   = false;
            $children = ['html' => $html, 'active' => $active];
            foreach ($items as $item) {
                $children_active = Cache::tags(['pages', 'menus'])->remember('page.children.' . $item->id,
                    config('app.cache_minutes'), function() use ($item) {
                        return $item->children;
                    });
                if ($children_active) {
                    $children = self::getMenuItems($children_active, $attributes, ($level + 1));
                }
                $menu_item = self::getMenuItem($item, $attributes, $level, $children);
                $active    = $active || $menu_item['active'] || $children['active'];
                $html      .= $menu_item['html'];
            }
            return [
                'active' => $active,
                'html'   => $html,
            ];
        }

        public static function getMenuItem($menu_item, $attributes, $level, $children)
        {
            switch ($menu_item->type) {
                case MenuItem::MENU_ITEM_LINK:
                    $link  = (isset($attributes['current_id']) && ($attributes['current_id'] === $menu_item->id)) ? '' : $menu_item->link;
                    $title = $menu_item->name ?? $menu_item->link;
                    break;
                case MenuItem::MENU_ITEM_PAGE_PARENT:
                    if (! $menu_item->menuable->active) {
                        return ['active' => false, 'html' => ''];
                    }
	                $link  = (isset($attributes['current_id']) && ($attributes['current_id'] === $menu_item->menuable->id)) ? '' : $menu_item->menuable->alias;
                    $title           = $menu_item->name ?? $menu_item->menuable->name;
                    $children_active = Cache::tags([
                        'pages',
                        'menus',
                    ])->remember('page.children.' . $menu_item->menuable->id, config('app.cache_minutes'),
                        function() use ($menu_item) {
                            return $menu_item->menuable->children_active;
                        });
                    $children        = self::getPageItems($children_active, $attributes, 1);
                    break;
                default:
                    if (! $menu_item->menuable->active) {
                        return ['active' => false, 'html' => ''];
                    }
	                $link  = (isset($attributes['current_id']) && ($attributes['current_id'] === $menu_item->menuable->id)) ? '' : $menu_item->menuable->alias;
                    $title = $menu_item->name ?? $menu_item->menuable->name;
                    break;
            }
            return self::parseMenuItem([
                'link'       => $link,
                'title'      => $title,
                'menu_item'  => $menu_item,
                'menuable'   => $menu_item->menuable ?? null,
                'properties' => $menu_item->properties,
                'children'   => $children,
            ], $attributes, $level, $children);
        }

        public static function getPageItems($items, $attributes, $level = 0)
        {
            $html     = '';
            $active   = false;
            $children = ['html' => $html, 'active' => $active];
            foreach ($items as $item) {
                $children_active = Cache::tags(['pages', 'menus'])->remember('page.children.' . $item->id,
                    config('app.cache_minutes'), function() use ($item) {
                        return $item->children_active;
                    });
                if ($children_active) {
                    $children = self::getPageItems($children_active, $attributes, ($level + 1));
                }
                $menu_item = self::parseMenuItem([
                    'link'       => $item->alias,
                    'title'      => $item->name,
                    'menu_item'  => null,
                    'menuable'   => $item,
                    'properties' => '',
                    'children'   => $children,
                ], $attributes, $level, $children);
                $active    = $active || $menu_item['active'] || $children['active'];
                $html      .= $menu_item['html'];
            }
            return [
                'active' => $active,
                'html'   => $html,
            ];
        }

        public static function parseMenuItem($view_parameters, $attributes, $level, $children)
        {
            $active   = request()->url() == $view_parameters['link'];
            $template = $attributes['template'] ?? 'default';
            //find level template by mask "{LEVEL}_row" or use default "row" (for active "{LEVEL}_row_active" or use default "row_active")
            $row_view = $active || (isset($attributes['active_parents']) && $attributes['active_parents'] && $children['active']) ? 'row_active' : 'row';
            $view     = view()->exists('frontend.elements.menu.' . $template . '.' . $level . '_' . $row_view) ?
                'frontend.elements.menu.' . $template . '.' . $level . '_' . $row_view :
                'frontend.elements.menu.' . $template . '.' . $row_view;

            return [
                'active' => $active,
                'html'   => view($view, [
                    'link'       => $view_parameters['link'],
                    'title'      => $view_parameters['title'],
                    'menu_item'  => $view_parameters['menu_item'],
                    'menuable'   => $view_parameters['menuable'],
                    'properties' => $view_parameters['properties'],
                    'children'   => $view_parameters['children']['html'],
                    'active'     => $active,
                ])->render(),
            ];
        }
    }
