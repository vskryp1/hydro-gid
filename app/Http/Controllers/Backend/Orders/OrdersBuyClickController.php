<?php


    namespace App\Http\Controllers\Backend\Orders;


    use App\Helpers\ShopHelper;
    use App\Http\Controllers\Controller;
    use App\Models\Order\OneClickOrders;
    use \Illuminate\Http\Request;

    class OrdersBuyClickController extends Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->middleware('permission:list orders buy click', ['only' => ['index']]);
        }

        public function index(Request $request)
        {
            $orders = OneClickOrders::when(($request->has('search') && $request->search != ''), function($orders) use ($request) {
                return $orders->where('name', 'like', '%' . $request->search . '%')
                              ->orWhere('email', 'like', '%' . $request->search . '%')
                              ->orWhere('phone', 'like', '%' . $request->search . '%');
            })->orderBy('created_at', 'desc');

            return view('backend.orders.orders_buy_click', [
                'orders'     => $orders->paginate($request->get('limit') ?? ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination'))),
                'permission' => 'orders',
            ]);
        }

        public function markAsViewed($clickOrders)
        {
            OneClickOrders::where('id',$clickOrders)->update(['status_new' => false]);

            return redirect(route('backend.orders.order_buy_click'))
                ->with('success', __('backend.settings_saved'));
        }
    }