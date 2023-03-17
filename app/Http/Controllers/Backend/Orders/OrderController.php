<?php

    namespace App\Http\Controllers\Backend\Orders;

    use App;
    use App\Enums\DeliveryType;
    use App\Helpers\OrderHelper;
    use App\Helpers\ShopHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Orders\OrderRequest;
    use App\Mail\Frontend\ChangeStatusMail;
    use App\Models\Client\Address;
    use App\Events\OrderCreatedEvent;
    use App\Models\Client\Client;
    use App\Models\Client\Temp_Client_Orders;
    use App\Models\Currency\Currency;
    use App\Models\Order\Delivery;
    use App\Models\Order\DeliveryPlace;
    use App\Models\Order\Order;
    use App\Models\Order\OrderStatus;
    use App\Models\Order\Payment;
    use App\Models\Product\Product;
    use App\Models\Region\Region;
    use App\Models\User;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\View\View;
    use LisDev\Delivery\NovaPoshtaApi2;
    use Mail;
    use Rap2hpoutre\FastExcel\Facades\FastExcel;

    class OrderController extends Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->middleware('permission:list orders', ['only' => ['index']]);
            $this->middleware('permission:add orders', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit orders', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete orders', ['only' => ['destroy', 'restore']]);
            $this->middleware('permission:export orders', ['only' => ['export']]);
        }

        /**
         * @param Request $request
         *
         * @return View
         */
        public function index(Request $request): View
        {
            $orders = Order::when(($request->has('search') && $request->search != ''), function ($orders) use ($request) {
                    return $orders->where('unique_id', 'like', "%" . $request->search . "%")
                        ->orWhereHas('client', function ($q) use  ($request) {
                            return $q->where('first_name', 'like', '%' . $request->search . '%')
                                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                                ->orWhere('email', 'like', '%' . $request->search . '%')
                                ->orWhere('phone', 'like', '%' . $request->search . '%');
                        })
                        ->orWhereHas('tempClients', function ($q) use  ($request) {
                            return $q->where('first_name', 'like', '%' . $request->search . '%')
                                     ->orWhere('last_name', 'like', '%' . $request->search . '%')
                                     ->orWhere('email', 'like', '%' . $request->search . '%')
                                     ->orWhere('phone', 'like', '%' . $request->search . '%');
                        });
                })->with([
                'order_status',
                'currency',
                'products.translations',
                'user',
                'client',
                'tempClients'
            ])->orderBy('created_at', 'desc');

            if (!auth()->user()->can('list all orders')) {
                $orders->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id)->orWhere('user_id', null);
                });
            }

            return view('backend.orders.index', [
                'orders'     => $orders->paginate($request->get('limit') ?? ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination'))),
                'permission' => 'orders',
            ]);
        }

        /**
         * @return View
         */
        public function create(): View
        {
            $deliveries       = Delivery::onlyActive()->byPosition()->get();
            $warehouse_routes = [];
            $deliveries->map(function ($item) use (&$warehouse_routes) {
                if ($item->type->is(DeliveryType::PICKUP_NP)) {
                    $warehouse_routes[$item->id] = route('ajax.cart.nova_poshta_warehouses', ['city' => '']);
                }
            });

            return view('backend.orders.create',
                [
                    'managers'        => User::onlyActive()->get()->pluck('name', 'id'),
                    'currencies_list' => Currency::get()->pluck('sign', 'id'),
                    'payments'        => Payment::onlyActive()->byPosition()->get()->pluck('name', 'id'),
                    'deliveries'      => $deliveries,
                    'delivery_places' => [],
                    'warehouses'      => [],
                    'regions'         => Region::onlyActive()->byPosition()->get()->pluck('name', 'id'),
                    'order_statuses'  => OrderStatus::onlyActive()->byPosition()->get()->pluck('name', 'id'),
                    'permission'      => 'orders',
                    'warehouse_routes' => $warehouse_routes,
                ]);
        }

        /**
         * @param OrderRequest $request
         *
         * @return RedirectResponse
         */
        public function store(OrderRequest $request): RedirectResponse
        {
            $data   = $request->all();
            $client = Client::find($data['client_id']);
            if (!$client) {
                $password         = uniqid();
                $data['password'] = bcrypt($password);
                $client           = Client::create($data);
                //TODO send email with $password
            } else {
                $client->update($data);
            }
            $data['client_id'] = $client->id;

            // create / update client address

            if (isset($data['city']) && $data['city'] != '') {
                // check address_id and create / update
                $address = Address::where('client_id', $data['client_id'])->first();
                if ($address == null) {
                    $address = Address::create($data);
                }
                $data['address_id'] = $address->id;
            }

            $delivery = Delivery::whereId($data['delivery_id'])->firstOrFail();
            if (isset($data['place_api_id'])
                && $delivery->type->in([DeliveryType::PICKUP_NP, DeliveryType::COURIER_NP])
            ) {
                $data['place_id'] = DeliveryPlace::where(
                    'api_id',
                    $data['place_api_id']
                )->firstOrFail()->id;
            }

            $total_price = 0;
            $currency = Currency::find($data['currency_id']);
            foreach ($data['products'] as $id => $product) {
                $p = Product::find($id);
                $data['products'][$id]['price'] = ShopHelper::price_convert($product['price'], $p->currency()->first(), $currency);
                $total_price += $product['qty'] * $data['products'][$id]['price'];
            }
            $data['total_price'] = $total_price;

            if (!auth()->user()->can('list all orders')) {
                $data['user_id'] = auth()->user()->id;
            }
            if($data["delivery_price"] == null){
                $data["delivery_price"] = 0;
            }

            $order = Order::create($data);
            foreach ($data['products'] as $id => $product){
                $data['products'][$id]['options'] = json_encode($product['options']);
            }
            $order->products()->sync($data['products']);
            $order->products()->sync($data['products']);

            event((new OrderCreatedEvent($client, $order)));

            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.orders.edit', ['order' => $order])
                    : route('backend.orders.index')
            )->with('success', ['text' => __('backend.order_created')]);
        }

        public function edit(string $id): View
        {
            $order = Order::with([
                'promocode',
                'client.addresses',
                'address',
                'delivery',
                'delivery_place',
                'products',
                'tempClients'
            ])->findOrFail($id);

            if (!auth()->user()->can('list all orders') && !is_null($order->user_id) && $order->user_id != auth()->user()->id) {
                throw \Spatie\Permission\Exceptions\UnauthorizedException::forPermissions(['list all orders']);
            }

            $delivery_places = $order->delivery_place ? [$order->delivery_place->api_id => $order->delivery_place->name] : [];

            $warehouses = OrderHelper::getWarehouseInfo($order);

            $deliveries       = Delivery::onlyActive()->byPosition()->get();
            $deliveryOptions  = [];
            $warehouse_routes = [];
            $deliveries->map(function ($item) use (&$deliveryOptions, &$warehouse_routes) {
                if ($item->type->is(DeliveryType::PICKUP_NP)) {
                    $warehouse_routes[$item->id] = route('ajax.cart.nova_poshta_warehouses', ['city' => '']);
                }
                $deliveryOptions[$item['id']] = ['data-delivery-price' => $item['price']];
            });

            return view('backend.orders.edit', [
                'order'                   => $order,
                'managers'                => User::onlyActive()->get()->pluck('name', 'id'),
                'currencies_list'         => Currency::get()->pluck('sign', 'id'),
                'payments'                => Payment::onlyActive()->byPosition()->get()->pluck('name', 'id'),
                'deliveries'              => $deliveries,
                'delivery_places'         => $delivery_places,
                'deliveryOptions'         => $deliveryOptions,
                'warehouses'              => $warehouses,
                'order_statuses'          => OrderStatus::onlyActive()->byPosition()->get()->pluck('name', 'id'),
                'permission'              => 'orders',
                'warehouse_routes'        => $warehouse_routes,
            ]);
        }

        /**
         * @param OrderRequest $request
         * @param string       $id
         *
         * @return RedirectResponse
         */
        public function update(OrderRequest $request, string $id): RedirectResponse
        {
            $data   = $request->all();

            if($data['client_id']){
                $client = Client::find($data['client_id']);
            } else {
                $client = Temp_Client_Orders::find($data['temp_client_id']);
            }

            $client->update([
            	'email' => $data['email'],
	            'phone' => $data['phone'],
            ]);

            $delivery = Delivery::whereId($data['delivery_id'])->firstOrFail();
            if (isset($data['place_api_id'])
                && $delivery->type->in([DeliveryType::PICKUP_NP, DeliveryType::COURIER_NP])
            ) {

                $data['place_id'] = DeliveryPlace::where(
                    'api_id',
                    $data['place_api_id']
                )->firstOrFail()->id;
            }

            if (isset($data['address_place_id']) && $data['address_place_id'] != '') {
                $addressData             = $data;
                $addressData['place_id'] = DeliveryPlace::where('api_id', $data['address_place_id'])->firstOrFail()->id;
                $address                 = Address::updateOrCreate(['id' => $data['address_id']], $addressData);
                $data['address_id']      = $address->id;
            }

            $total_price = 0;
            foreach ($data['products'] as $product) {
                $total_price                      += $product['qty'] * $product['price'];
                $option                           = $product['options'];
                $total_price                      += isset($option['warranty']) ? $option['warranty']['price'] : 0;
            }
            $data['total_price'] = $total_price;

            if (!auth()->user()->can('list all orders')) {
                $data['user_id'] = auth()->user()->id;
            }

            $order = Order::findOrFail($id);
            $order->update($data);

            foreach ($data['products'] as $id => $product){
                $data['products'][$id]['options'] = json_encode($product['options']);
            }
            $order->products()->sync($data['products']);

            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.orders.edit', ['order' => $order])
                    : route('backend.orders.index')
            )->with('success', ['text' => __('backend.order_updated')]);
        }

        /**
         * @param string $id
         *
         * @return RedirectResponse
         */
        public function destroy(string $id): RedirectResponse
        {
            $order = Order::findOrFail($id);
            if (!auth()->user()->can('list all orders') && $order->user_id != auth()->user()->id) {
                throw \Spatie\Permission\Exceptions\UnauthorizedException::forPermissions(['list all orders']);
            }
            $order->destroy($id);
            return redirect(route('backend.orders.index'))
                ->with('success', ['text' => __('backend.order_deleted')]);
        }

        /**
         * @param Request $request
         *
         * @return Client
         */
        public function getClientData(Request $request): Client
        {
            return Client::with('addresses')->find($request->id);
        }

        /**
         * @param Request $request
         *
         * @return JsonResponse
         * @throws \Exception
         * @throws \Throwable
         */
        public function searchProducts(Request $request): JsonResponse
        {
            $query    = $request->get('query', '');
            $products = Product::where('name', 'LIKE', '%' . $query . '%')->get();

            return response()->json([
                'product' => view('backend.orders.product-search.products-search')
                    ->with('products', $products)->render(),
            ]);
        }

        /**
         * Exports order to xlsx.
         *
         * @param string $id
         *
         * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
         */
        public function export(string $id)
        {
            $order = Order::where('id', $id)->get()->first();

            return FastExcel::data(collect([$order]))->download($id . '_order.xlsx');
        }
    }
