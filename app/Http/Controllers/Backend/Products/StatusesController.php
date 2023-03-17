<?php

namespace App\Http\Controllers\Backend\Products;

use App\Helpers\ShopHelper;
use App\Http\Requests\Backend\Products\StatusStoreRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductStatus;
use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list product statuses', ['only' => ['index']]);
        $this->middleware('permission:add product statuses', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit product statuses', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete product statuses', ['only' => ['destroy']]);
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
        $productStatuses = ProductStatus::byPosition()->with(['translations']);//'categories',

        if ($request->search != '') {
            $productStatuses = $productStatuses
                ->whereTranslationLike('name', "%" . $request->search . "%");
        }

        return view('backend.product-statuses.index', [
            'product_statuses' => $productStatuses->paginate($request->get('limit', ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination', 25)))),
            'permission'       => 'product statuses',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product-statuses.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StatusStoreRequest $request)
    {
        $data             = $request->all();
        $data['active']   = isset($request->active);
        $data['in_stock'] = isset($request->in_stock);
	    if ($request->default == true && $request->active == true) {
		    //reset all default
		    ProductStatus::whereDefault(true)->update(['default' => false]);
		    $data['default'] = $request->default;
	    }
        $productStatus    = ProductStatus::create($data);
        Cache::tags('statuses')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.products.statuses.edit', ['status' => $productStatus])
                : route('backend.products.statuses.index')
        )->with('success', ['text' => __('backend.status_created')]);
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
        return view('backend.product-statuses.edit', [
            'product_status' => ProductStatus::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param         $productStatus
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $productStatus)
    {
        $data             = $request->all();
        $data['active']   = isset($request->active);
        $data['in_stock'] = isset($request->in_stock);
	    if ($request->default == true && $request->active == true) {
		    //reset all default
		    ProductStatus::whereDefault(true)->update(['default' => false]);
		    $data['default'] = true;
	    }
        ProductStatus::findOrFail($productStatus)->update($data);
        Cache::tags('statuses')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.products.statuses.edit', ['status' => $productStatus])
                : route('backend.products.statuses.index')
        )->with('success', ['text' => __('backend.status_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $productStatus
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($productStatus)
    {
        ProductStatus::destroy($productStatus);
        Cache::tags('statuses')->flush();
        return redirect(route('backend.products.statuses.index'))->with('success', ['text' => __('backend.status_deleted')]);
    }
}
