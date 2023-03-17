<?php

namespace App\Http\Controllers\Backend\Filters;

use App;
use App\Helpers\ShopHelper;
use App\Http\Requests\Backend\Filters\ByCategoryRequest;
use App\Http\Requests\Backend\Filters\SaveRequest;
use App\Models\Filters\Filter;
use App\Models\Filters\FilterType;
use App\Models\Filters\FilterValue;
use App\Models\Page\Page;
use App\Models\Product\Product;
use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FiltersController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list filters', ['only' => ['index']]);
        $this->middleware('permission:add filters', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit filters', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete filters', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filters = Filter::with(['filter_type', 'translations', 'pages.translations'])
            ->when($request->has('search'), function ($query) {
                return $query->whereHas('translations', function ($query) {
                    return $query->where('name', 'like', "%" . request('search') . "%");
                });
            });

        return view('backend.filters.index', [
            'filters'    => $filters->paginate($request->get('limit') ?? ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination'))),
            'permission' => 'filters',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.filters.create', [
            'filter_types'       => FilterType::get()->pluck('name', 'id')->toArray(),
            'product_categories' => Page::productCategories()->get()->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRequest $request)
    {
        $data              = $request->all();
        $data['active']    = isset($request->active);
        $data['is_option'] = isset($request->is_option);
        $filter            = Filter::create($data);

        $filter->pages()->sync($data['categories']);
        Cache::tags('filters')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.filters.edit', ['filter' => $filter])
                : route('backend.filters.index')
        )->with('success', ['text' => __('backend.filter_created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filter = Filter::with(['filter_values', 'filter_type', 'pages'])->findOrFail($id);

        return view('backend.filters.edit', [
            'filter'             => $filter,
            'filter_types'       => FilterType::get()->pluck('name', 'id')->toArray(),
            'filter_values'      => FilterValue::whereFilterId($filter->id)->paginate(ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination'))),
            'product_categories' => Page::productCategories()->get()->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaveRequest $request
     * @param             $filter
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveRequest $request, $filter)
    {
        $data = $request->all();
        $filter = Filter::findOrFail($filter);
        $filter->update($data);

        //if remove some category detach filter values from product where used previous categories
        $fv = $filter->filter_values->pluck('id');
        $filter->pages->whereNotIn('id',$data['categories'])->map(function ($category) use ($fv){
            $category->products->map(function ($product) use ($fv){
                $product->filter_values()->detach($fv);
            });
        });

        $filter->pages()->sync($data['categories']);
        Cache::tags('filters')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.filters.edit', ['filter' => $filter])
                : route('backend.filters.index')
        )->with('success', ['text' => __('backend.filter_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $filter
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($filter)
    {
        Filter::destroy($filter);
        Cache::tags('filters')->flush();
        return redirect(route('backend.filters.index'))->with('success', ['text' => __('backend.filter_deleted')]);
    }

    public function byCategories(ByCategoryRequest $request)
    {
        $filters = Filter::onlyActive()->filtersSort()->with(['filter_type', 'filter_values'])->whereHas('pages',
            function ($query) use ($request) {
                $query->whereIn('id', $request->categories);
            })->get();

        $product = Product::with('filter_values')->find($request->product);

        $html = '';
        if ($filters) {
            foreach ($filters as $filter) {
                $html .= view('backend.filters.types.' . $filter->filter_type->file, [
                    'filter'         => $filter,
                    'filter_values'  => $filter->filter_values->pluck('name', 'id')->toArray(),
                    'product_values' => $product ? $product->filter_values->pluck('id')->toArray() : [],
                ])->render();
            }
        }

        return response()->json(['filters' => $html]);
    }
}
