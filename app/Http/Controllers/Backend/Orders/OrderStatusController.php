<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Helpers\ShopHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Orders\OrderStatusRequest;
use App\Models\Order\Order;
use App\Models\Order\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list order statuses', ['only' => ['index']]);
        $this->middleware('permission:add order statuses', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit order statuses', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete order statuses', ['only' => ['destroy', 'restore']]);
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
        $orderStatuses = OrderStatus::byPosition()->with(['translations']);

        if ($request->has('search')) {
            $orderStatuses = $orderStatuses->where(function ($query) use ($request) {
                $query->whereTranslationLike('name', "%" . $request->search . "%");
            });
        }

        return view('backend.orders.statuses.index', [
            'order_statuses' => $orderStatuses->paginate($request->get('limit', ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination', 25)))),
            'permission'     => 'order statuses',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.orders.statuses.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderStatusRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusRequest $request)
    {
        $this->resetDefaultStatus($request);
        $data            = $request->all();
        $data['active']  = isset($request->active);
        $data['default'] = isset($request->default);
        $orderStatuses   = OrderStatus::create($data);
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.orders.statuses.edit', ['status' => $orderStatuses])
                : route('backend.orders.statuses.index')
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
        return view('backend.orders.statuses.edit', [
            'order_status' => OrderStatus::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param         $orderStatuses
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrderStatusRequest $request, $orderStatuses)
    {
        $this->resetDefaultStatus($request);
        $data               = $request->all();
        $data['active']     = isset($request->active);
        $data['default']    = isset($request->default);
	    $data['processed']  = isset($request->processed);
        OrderStatus::findOrFail($orderStatuses)->update($data);
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.orders.statuses.edit', ['status' => $orderStatuses])
                : route('backend.orders.statuses.index')
        )->with('success', ['text' => __('backend.status_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $orderStatuses
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($orderStatuses)
    {
        OrderStatus::destroy($orderStatuses);
        return redirect(route('backend.orders.statuses.index'))->with('success', ['text' => __('backend.status_deleted')]);
    }

    /**
     * @param $request
     */
    public function resetDefaultStatus($request)
    {
        if ($request->get('active') && $request->get('default')) {
            OrderStatus::onlyActive()->update(['default' => false]);
        }
    }
}
