<?php

    namespace App\Http\Controllers\Backend\Orders;

    use App\Helpers\ShopHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\ServiceOrder\SaveFormRequest;
    use App\Models\Order\ServiceOrder;

    class ServiceOrderController extends Controller
    {
        protected $permission = 'service order';

        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:list ' . $this->permission, ['only' => ['index']]);
            $this->middleware('permission:add ' . $this->permission, ['only' => ['create', 'store']]);
            $this->middleware('permission:edit ' . $this->permission, ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete ' . $this->permission, ['only' => ['destroy']]);
        }

        public function index()
        {
            $permission    = $this->permission;
            $serviceOrders = ServiceOrder::query()->orderByDesc('created_at')->paginate(config('app.limits.backend.pagination'));

            return view('backend.service_orders.index', compact('serviceOrders', 'permission'));
        }

        public function create()
        {
            $permission = $this->permission;
            $services   = ShopHelper::getServices()->pluck('name', 'id');

            return view('backend.service_orders.create', compact('permission', 'services'));
        }

        public function edit(ServiceOrder $serviceOrder)
        {
            $permission = $this->permission;
            $services   = ShopHelper::getServices()->pluck('name', 'id');

            return view('backend.service_orders.edit', compact('serviceOrder', 'permission', 'services'));
        }

        public function store(SaveFormRequest $request)
        {
            $serviceOrder = ServiceOrder::create($request->all());

            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.service-orders.edit', $serviceOrder)
                    : route('backend.service-orders.index')
            )->with('success', ['text' => __('backend/service/index.created')]);
        }

        public function update(SaveFormRequest $request, ServiceOrder $serviceOrder)
        {
            $serviceOrder->update($request->all());

            if ($request->filled('action')) {
                return redirect()->back()->with('success', ['text' => __('backend/service/index.updated')]);
            }

            return redirect()
                ->route('backend.service-orders.index')
                ->with('success', ['text' => __('backend/service/index.updated')]);
        }

        public function destroy(ServiceOrder $serviceOrder)
        {
            $serviceOrder->delete();

            return redirect()
                ->route('backend.service-orders.index')
                ->with('success', ['text' => __('backend/service/index.deleted')]);
        }
    }
