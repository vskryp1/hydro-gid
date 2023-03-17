<?php

    namespace App\Http\Controllers\Backend\Menus;

    use App\Helpers\ShopHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Menus\SaveRequest;
    use App\Models\Menu\Menu;
    use App\Models\Menu\MenuItem;
    use App\Models\Page\Page;
    use Cache;

    class MenusController extends Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->middleware('permission:list menus', ['only' => ['index']]);
            $this->middleware('permission:add menus', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit menus', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete menus', ['only' => ['destroy']]);
        }

        public function index()
        {
            $menus      = Menu::paginate(ShopHelper::setting('backend_paginate_limit',
                config('app.limits.backend.pagination')));
            $permission = 'menus';

            return view('backend.menus.index', compact('menus', 'permission'));
        }

        public function create()
        {
            $types = collect(Menu::MENU_TYPES)->map(function($menuType) {
                return __("backend.{$menuType}");
            });
            $pages     = Page::all()->pluck('name', 'id')->prepend(__('backend.no_parent_page'), '');

            return view('backend.menus.create', compact('types', 'pages'));
        }

        public function store(SaveRequest $request)
        {
            $menu = Menu::create($request->all());

            Cache::tags('menus')->flush();

            return redirect($this->getRedirectRouteString($menu))
                ->with('success', ['text' => __('backend.menu_created')]);
        }

        public function edit(Menu $menu)
        {
            $types     = collect(Menu::MENU_TYPES)->map(function($menuType) {
                return __("backend.{$menuType}");
            });
            $pages     = Page::all()->pluck('name', 'id')->prepend(__('backend.no_parent_page'), '');
            $menuItems = MenuItem::byPosition()
                ->where('menu_id', $menu->id)
                ->paginate(200);

            return view('backend.menus.edit', compact('menu', 'types', 'pages', 'menuItems'));
        }

        public function update(SaveRequest $request, Menu $menu)
        {
            $menu->update($request->all());

            Cache::tags('menus')->flush();

            return redirect($this->getRedirectRouteString($menu))
                ->with('success', ['text' => __('backend.menu_updated')]);
        }

        public function destroy(Menu $menu)
        {
            $menu->delete();

            Cache::tags('menus')->flush();

            return redirect($this->getRedirectRouteString($menu))
                ->with('success', ['text' => __('backend.menu_deleted')]);
        }

        private function getRedirectRouteString(Menu $menu): string
        {
            return request()->input('action') === 'continue'
                ? route('backend.menus.edit', ['menu' => $menu])
                : route('backend.menus.index');
        }
    }
