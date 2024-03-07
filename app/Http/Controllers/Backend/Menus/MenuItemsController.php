<?php

    namespace App\Http\Controllers\Backend\Menus;

    use App\Helpers\ImageHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Menus\Items\SaveRequest;
    use App\Models\Menu\Menu;
    use App\Models\Menu\MenuItem;
    use App\Models\Page\Page;
    use App\Models\Product\Product;
    use Cache;
    use Illuminate\Http\Request;
    use Setting;
    use Storage;

    /**
     * Class RegionController
     *
     * @package App\Http\Controllers\Backend
     */
    class MenuItemsController extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:add menus', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit menus', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete menus', ['only' => ['destroy']]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @param $menu
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create($menu)
        {
            $types = MenuItem::MENU_ITEM_TYPES;
            foreach ($types as $key => $type) {
                $types[$key] = __('backend.menu_type_' . $key);
            }
            $menu_items = MenuItem::whereMenuId($menu)->get();
            $parents    = ['' => __('backend.no_data')];
            foreach ($menu_items as $mi) {
                $parents[$mi->id] = $mi->menuable->name ?? $mi->name;
            }
            return view('backend.menus.items.create', [
                'types'      => $types,
                'menu_items' => $parents,
                'menu'       => $menu
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param SaveRequest $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(SaveRequest $request)
        {
            $data = $request->all();

            $path = Menu::GALLERY_PATH . $data['menu_id'];
            foreach (Setting::get('locales') as $lang => $locale) {
                if (isset($data[$lang]['image'])) {
                    $data[$lang]['image'] = ImageHelper::generateName($path, $request->file($lang . '.image')->getClientOriginalName());
                    Storage::disk('public')->putFileAs($path, $request->file($lang . '.image'), $data[$lang]['image']);
                }
            }

            $menu_item = MenuItem::create($data);
            Cache::tags('menus')->flush();
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.menus.menu_items.edit',
                    ['menu' => $menu_item->menu_id, 'menu_item' => $menu_item])
                    : route('backend.menus.edit', ['menu' => $menu_item->menu_id]) . '#menu_items'
            )->with('success', ['text' => __('backend.menu_items_created')]);
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param $menu
         * @param $menu_item
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit($menu, $menu_item)
        {
            $types = MenuItem::MENU_ITEM_TYPES;
            foreach ($types as $key => $type) {
                $types[$key] = __('backend.menu_type_' . $key);
            }
            $menu_items = MenuItem::where('id', '<>', $menu_item)->where(function ($query) use ($menu_item) {
                return $query->whereNull('menu_item_id')->orWhere('menu_item_id', '<>', $menu_item);
            })->whereMenuId($menu)->get();
            $parents    = ['' => __('backend.no_data')];
            foreach ($menu_items as $mi) {
                $parents[$mi->id] = $mi->menuable->name ?? $mi->name;
            }
            return view('backend.menus.items.edit', [
                'menu_item'  => MenuItem::findOrFail($menu_item),
                'types'      => $types,
                'menu_items' => $parents,
                'menu'       => $menu
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param SaveRequest            $request
         * @param                        $menu
         * @param                        $menu_item
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(SaveRequest $request, $menu, $menu_item)
        {
            $data = $request->all();

            $path = Menu::GALLERY_PATH . $data['menu_id'];
            foreach (Setting::get('locales') as $lang => $locale) {
                if (isset($data[$lang]['image'])) {
                    $data[$lang]['image'] = ImageHelper::generateName($path, $request->file($lang . '.image')->getClientOriginalName());
                    Storage::disk('public')->putFileAs($path, $request->file($lang . '.image'), $data[$lang]['image']);
                }
            }

            MenuItem::findOrFail($menu_item)->update($data);
            Cache::tags('menus')->flush();
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.menus.menu_items.edit', ['menu' => $menu, 'menu_item' => $menu_item])
                    : route('backend.menus.edit', ['menu' => $menu]) . '#menu_items'
            )->with('success', ['text' => __('backend.menu_items_updated')]);

        }

        /**
         * Remove the specified resource from storage.
         *
         * @param $menu
         * @param $menu_item
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy($menu, $menu_item)
        {
            MenuItem::destroy($menu_item);
            Cache::tags('menus')->flush();
            return redirect(route('backend.menus.edit', ['menu' => $menu]) . '#menu_items')
                ->with('success', ['text' => __('backend.menu_items_deleted')]);
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function updateSort(Request $request)
        {
            $parent     = $request->parent_id == "#" || $request->parent_id == "root" ? null : $request->parent_id;
            $old_parent = $request->old_parent == "#" || $request->old_parent == "root" ? null : $request->old_parent;
            if ($parent != $old_parent) {
                MenuItem::where('menu_item_id', $old_parent)
                    ->where('position', '>', $request->old_position + 1)
                    ->decrement('position');
                MenuItem::where('menu_item_id', $parent)
                    ->where('position', '>=', $request->position + 1)
                    ->increment('position');
            } else {
                if ($request->position + 1 > $request->old_position + 1) {
                    MenuItem::where('menu_item_id', $parent)
                        ->where('position', '>', $request->old_position + 1)
                        ->where('position', '<=', $request->position + 1)
                        ->decrement('position');
                } else {
                    MenuItem::where('menu_item_id', $parent)
                        ->where('position', '>=', $request->position + 1)
                        ->where('position', '<', $request->old_position + 1)
                        ->increment('position');
                }
            }
            MenuItem::find($request->id)->update([
                'position'       => $request->position + 1,
                'menu_item_id' => $parent,
            ]);
            Cache::tags('menus')->flush();
            return response()->json(['status' => true]);
        }
    }
