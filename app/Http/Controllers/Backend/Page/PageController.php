<?php

    namespace App\Http\Controllers\Backend\Page;

    use App\Events\UrlWasBorn;
    use App\Helpers\ImageHelper;
    use App\Http\Requests\Backend\Page\PageRequest;
    use App\Jobs\ResizeImageJob;
    use App\Models\Page\Page;
    use App\Models\Page\PageAdditionalFieldValue;
    use App\Models\Page\PageTemplate;
    use App\Models\Product\Product;
    use App\Models\Seo\Sitemap;
    use Cache;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Storage;

    class PageController extends Controller
    {
        private $ids;

        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:list pages', ['only' => ['index']]);
            $this->middleware('permission:add pages', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit pages', ['only' => ['edit', 'update', 'updateParent', 'updateSorts']]);
            $this->middleware('permission:delete pages', ['only' => ['destroy']]);
        }


        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         * @internal param Request $request
         */
        public function updateSortProducts(Request $request)
        {
            if(is_array($request->products) && count($request->products) > 0) {
                $page = Page::with('products')->findOrFail($request->page);
                foreach($request->products as $position => $id) {
                    $products[$id] = [
                        'order_sort' => $position,
                        'is_main' => '0',
                        'page_id' => $request->page
                    ];
                }
                $page->products()->sync($products);
            }
            return redirect()->back()->with('success', ['text' => __('backend.sort_saved')]);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         * @internal param Request $request
         */
        public function resetSortProducts($pid)
        {
            $page = Page::with('products')->findOrFail($pid);
            $page->products()->where('page_id', $pid)->update(['order_sort' => 0]);
            return redirect()->back()->with('success', ['text' => __('backend.sort_reset')]);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         * @internal param Request $request
         */
        public function pageProducts($page)
        {
            $page = Page::with(['products' => function($query) {
                return $query
                    ->orderBy('pivot_order_sort')
                    ->orderBy('active', 'desc')
                    ->orderBy('product_id', 'desc')
                    ->orderBy('updated_at', 'desc');
            }])->findOrFail($page);
            return view('backend.pages.products', [
                'products'      => $page->products,
                'page'          => $page,
                'reset_sort'    => route('backend.pages.reset.product.sort', ['page' => $page->id]),
            ]);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         * @internal param Request $request
         */
        public function index()
        {
            return view('backend.pages.index', [
                'pages' => Page::all()->sortBy('position'),
            ]);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create()
        {
            $templates = PageTemplate::onlyActive()->get()->pluck('name', 'id');
            return view('backend.pages.create', [
                'templates' => $templates,
                'pages'     => Page::all()->sortBy('position'),
                'products'  => Product::onlyActive()->get()->pluck('name', 'id'),
            ]);
        }

        /**
         * @param PageRequest $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(PageRequest $request)
        {
            $page        = Page::create($request->all());
            $biggestSort = Page::where('parent_page_id', $request->parent_page_id)
                ->orderBy('position', 'desc')
                ->pluck('position')
                ->first();
            $page->position  = $biggestSort + 1;
            $page->save();

            event(new UrlWasBorn($page));

            Cache::tags('pages')->flush();

            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.pages.edit', ['id' => $page])
                    : route('backend.pages.index')
            )->with('success', ['text' => __('backend.page_created')]);
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit(Request $request)
        {
            $page                  = Page::with('parent', 'page_template')->findOrFail($request->page);
            $breadcrumb            = [];
            $breadcrumb[$page->id] = $page->name;
            $urls[$page->alias]      = $page->alias;
            $parent                = $page->parent;
            while ($parent != null) {
                $breadcrumb[$parent->id] = $page->name;
                $urls[$parent->id]       = $parent->alias;
                $parent                  = $parent->parent_page_id != 1 ? $parent->parent()->first() : null;
            }
            $breadcrumbs = array_reverse($breadcrumb, true);
            return view('backend.pages.edit', [
                'breadcrumbs'     => $breadcrumbs,
                'urls'            => $page->alias,
                'page'            => $page,
                'templates'       => PageTemplate::onlyActive()->get()->pluck('name', 'id'),
                'page_add_fields' => $page->page_template ? $page->page_template->page_additional_field : [],
                'pages'           => Page::where('id', '<>', $page->id)->get(),
                'products'        => Product::onlyActive()->get()->pluck('name', 'id'),
            ]);
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function updateSort(Request $request)
        {
            if ($request->parent_id != $request->old_parent) {
                Page::where('parent_page_id', $request->old_parent)
                    ->where('position', '>', $request->old_position + 1)
                    ->decrement('position');
                Page::where('parent_page_id', $request->parent_id)
                    ->where('position', '>=', $request->position + 1)
                    ->increment('position');
            } else {
                if ($request->position + 1 > $request->old_position + 1) {
                    Page::where('parent_page_id', $request->parent_id)
                        ->where('position', '>', $request->old_position + 1)
                        ->where('position', '<=', $request->position + 1)
                        ->decrement('position');
                } else {
                    Page::where('parent_page_id', $request->parent_id)
                        ->where('position', '>=', $request->position + 1)
                        ->where('position', '<', $request->old_position + 1)
                        ->increment('position');
                }
            }
            Page::find($request->id)->update([
                'position'           => $request->position + 1,
                'parent_page_id' => $request->parent_id,
            ]);
            Cache::tags('pages')->flush();
            return response()->json(['status' => true]);
        }

        /**
         * @param PageRequest $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(PageRequest $request)
        {
            $page = Page::findOrFail($request->page);
            $page->update($request->all());
            if ($request->has('add') && count($request->add) > 0) {
                $path = Page::GALLERY_PATH . $request->page;
                foreach ($request->add as $type => $field) {
                    foreach ($field as $field_id => $value) {
                        $pafv = PageAdditionalFieldValue::firstOrNew([
                            'page_additional_field_id' => $field_id,
                            'page_id'                  => $request->page,
                        ]);
                        if ($type == 'file') {
                            foreach ($value as $lang => &$image) {
                                $pafvModel = $pafv->translate($lang);
                                if(is_file($image['value'])) {
                                    if ($pafv && $pafvModel) {
                                        Storage::disk('public')->delete(Page::GALLERY_PATH.$pafv->translate($lang)->value);
                                    }
                                    $name = ImageHelper::generateName($path, $image['value']->getClientOriginalName());
                                    Storage::disk('public')->putFileAs($path, $image['value'], $name);
                                    $image['value'] = $name;
                                    dispatch(
                                        new ResizeImageJob(
                                            $path . DIRECTORY_SEPARATOR . $name,
                                            config('customimagecache.types.pages'),
                                            'pages'
                                        )
                                    );
                                }elseif(isset($pafvModel) && $image['value'] == '' && $pafv->translate($lang)->value){
                                    Storage::disk('public')->delete(Page::GALLERY_PATH.$pafv->translate($lang)->value);
                                }
                            }
                        }
                        $pafv->fill($value)->save();
                    }
                }
            }
            if($request->products){
                $page->products()->sync($request->products);
            }
            event(new UrlWasBorn($page));
            Cache::tags('pages')->flush();
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.pages.edit', ['id' => $page])
                    : route('backend.pages.index')
            )->with('success', ['text' => __('backend.page_updated')]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param $id
         *
         * @return \Illuminate\Http\Response
         * @internal param int $loc
         */
        public function destroy($id)
        {
            $page = Page::with('children')->find($id);
            if (!$this->getAllChilds($page)) {
                Page::destroy($this->ids);
            }
            if (isset($page->page_template->folder) && $page->page_template->folder == 'main') {
                return redirect()->route('backend.pages.index')->with('danger',
                    ['text' => __('backend.cant_delete_main')]);
            }
            $this->cleanPagesStorage($page);
            Page::destroy($id);
            Cache::tags('pages')->flush();
            Sitemap::whereModel($page->getMorphClass())->whereModelId($id)->delete();

            return redirect()->route('backend.pages.index')->with('success', ['text' => __('backend.page_deleted')]);
        }

        /**
         * get All childs page
         *
         * @param $page
         */
        private function getAllChilds($page)
        {
            foreach ($page->children as $child) {
                $this->cleanPagesStorage($child);
                $this->ids[] = $child->id;
                if (count($child->children) > 0) {
                    $this->getAllChilds($child);
                }
            }
        }

        /**
         * @param Page $page
         */
        private function cleanPagesStorage($page)
        {
            if(isset($page->page_additional_field_values)){
                foreach ($page->page_additional_field_values as $pageAddFieldVal) {
                    if ($pageAddFieldVal->parent->page_additional_field_type->type == 'file') {
                        Storage::disk('public')->deleteDirectory(Page::GALLERY_PATH . $page->id);
                    }
                }
            }
        }

	    /**
	     * search pages from autocomplete
	     * @param Request $request
	     *
	     * @return \Illuminate\Http\JsonResponse
	     */
	    public function search(Request $request)
	    {
		    $search = trim($request->get('q', ''));
		    $pages = Page::with(['translations'])->whereTranslationLike('name', "%" . $search . "%");

		    $pages = $pages->take(10)->get();

		    return response()->json($pages);
	    }
    }
