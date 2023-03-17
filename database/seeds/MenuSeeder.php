<?php

    use App\Models\Menu\Menu;
    use App\Models\Menu\MenuItem;
    use App\Models\Page\Page;
    use Illuminate\Database\Seeder;

    class MenuSeeder extends Seeder
    {
        public function run(): void
        {
            $catalog_menu = Menu::create([
                'page_id' => null,
                'alias'   => 'catalog-menu',
                'type'    => Menu::MENU_CONSTRUCTOR,
            ]);

            $aliases = [
                'gidravlicheskie-nasosy',
                'gidroraspredeliteli',
                'gidromotory',
                'gidroakkumulyatory',
                'manometry',
            ];

            $pages = Page::byPosition()
                         ->whereIn('alias', $aliases)
                         ->get()
                         ->keyBy(function(Page $page) {
                             return $page->getOriginal('alias');
                         });

            collect($aliases)
                ->each(function(string $alias, $position) use ($pages, $catalog_menu) {
                    $menuItem = MenuItem::create(
                        [
                            'menu_id'       => $catalog_menu->id,
                            'menu_item_id'  => null,
                            'menuable_type' => MenuItem::MENU_ITEM_TYPES[MenuItem::MENU_ITEM_PAGE],
                            'menuable_id'   => $pages[$alias]->id,
                            'position'      => ++$position,
                            'type'          => MenuItem::MENU_ITEM_PAGE,
                            'ru'            => [
                                'name' => $pages[$alias]->translate('ru')->name,
                            ],
                            'uk'            => [
                                'name' => $pages[$alias]->translate('uk')->name,
                            ],
                        ]
                    );

                    Page::byPosition()
                        ->where('parent_page_id', $pages[$alias]->id)
                        ->get()
                        ->each(function(Page $pageChild, $position) use ($menuItem, $catalog_menu, $alias) {
                            MenuItem::create(
                                [
                                    'menu_id'       => $catalog_menu->id,
                                    'menu_item_id'  => $menuItem->id,
                                    'menuable_type' => MenuItem::MENU_ITEM_TYPES[MenuItem::MENU_ITEM_PAGE],
                                    'menuable_id'   => $pageChild->id,
                                    'position'      => ++$position,
                                    'type'          => MenuItem::MENU_ITEM_PAGE,
                                    'ru'            => [
                                        'name' => $pageChild->translate('ru')->name,
                                    ],
                                    'uk'            => [
                                        'name' => $pageChild->translate('uk')->name,
                                    ],
                                ]
                            );
                        });

                });
        }
    }
