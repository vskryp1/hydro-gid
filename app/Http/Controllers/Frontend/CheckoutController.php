<?php

    namespace App\Http\Controllers\Frontend;

    use App;
    use App\Enums\DeliveryType;
    use App\Enums\PageAlias;
    use App\Events\OrderCreatedNoAuthEvent;
    use App\Helpers\CartHelper;
    use App\Helpers\LiqPay;
    use App\Helpers\ShopHelper;
    use App\Http\Requests\Frontend\Auth\RegisterRequest;
    use App\Http\Requests\Frontend\Checkout\StoreStep1Request;
    use App\Http\Requests\Frontend\Checkout\StoreStep2Request;
    use App\Models\Client\Address;
    use App\Models\Client\Temp_Client_Orders;
    use App\Models\Order\DeliveryPlace;
    use App\Models\Order\Order;
    use App\Models\Order\OrderStatus;
    use App\Http\Controllers\Controller;
    use App\Models\Order\Payment;
    use App\Events\RegistrationUserEvent;
    use Gloudemans\Shoppingcart\Facades\Cart;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use LaravelLocalization;
    use Log;
    use App\Models\Client\Client;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Enums\PaymentType;
    use App\Events\OrderCreatedEvent;
    use App\Helpers\PrivatPayParts;

    class CheckoutController extends Controller
    {

        public function __construct()
        {
            parent::__construct();

            $this->middleware('page')->except(['auth', 'login']);
        }

        /**
         * Store first step
         *
         * @param \App\Http\Requests\Frontend\Checkout\StoreStep1Request $request
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function storeStep1(StoreStep1Request $request)
        {
            $client = auth('web')->user();
            if (!$client) {
                $client = new Temp_Client_Orders();
                $client->fill($request->all());
                session()->put([
                    'new_client' => true,
                    'temp_user'  => $client,
                ]);
            } else {
                $client->update($request->all());
            }

            return redirect(route('frontend.page', ['alias' => PageAlias::PAGE_CHECKOUT_STEP_2]), 301);
        }

        /**
         * Store second step
         *
         * @param StoreStep2Request $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function storeStep2(StoreStep2Request $request)
        {
            $data   = $request->all();
            $client = auth('web')->user() ?? session()->get('temp_user');

            if (!Client::where('email', $client->email)->exists()) {
                $client->save();
            }

            if ($client instanceof Client) {
                $data['client_id'] = $client->id;
            } else {
                $data['temp_client_id'] = $client->id;
            }

            $delivery = ShopHelper::current_delivery();
            $payment  = ShopHelper::current_payment();

            if (isset($data['place_api_id'])
                && $delivery->type->in([DeliveryType::PICKUP_NP, DeliveryType::COURIER_NP])
            ) {
            	$delivery_place = DeliveryPlace::where(
                    'api_id',
                    $data['place_api_id']
                )->firstOrFail();

	            if ($delivery->type->is(DeliveryType::COURIER_NP)) {
                    $baseAddressData = [
                        'place_id' => $delivery_place['id'],
                        'street'   => $data['street'],
                        'house'    => $data['house'],
	                    'city'     => $delivery_place->name
                    ];

                    if ($client instanceof Client) {
                        $addressData = ['client_id' => $data['client_id'],
                        ];
                    } else {
                        $addressData = ['temp_client_id' => $data['temp_client_id'],
                        ];
                    }

                    $address            = Address::create(array_merge($baseAddressData, $addressData));
                    $data['address_id'] = $address->id;
                } else {
	            	$data['place_id']  = $delivery_place['id'];
	            }
            }

            $order_status            = OrderStatus::onlyActive()->orderBy('default', 'desc')->byPosition()->first();
            $data['order_status_id'] = $order_status->id;
            $totalProductsPrice      = CartHelper::totalProductsPrice();
            $data['total_price']     = $totalProductsPrice;
            $data['discount']        = CartHelper::getDiscount();
            $data['currency_id']    = ShopHelper::current_currency()->id;
            $data['locale']         = LaravelLocalization::getCurrentLocale();
            $data['delivery_price'] = ShopHelper::price_convert($delivery->price);
            $order = Order::create($data);

            $order->products()->attach(CartHelper::getProductsForOrder());

            foreach(session()->get('cart')['default'] as $key => $item){
                $productList[] = [
                    'name' => $item->model->name,
                    'price' => str_replace(' ', '', $item->model->format_price),
                    'count' => $item->qty
                ];
            }

            $products = session()->get('cart')['default']->map(function($item){
                return [
                    'sku' => $item->model->sku,
                    'name' => $item->model->name,
                    'price' => str_replace(' ', '', $item->model->format_price),
                    'category' => $item->model->getMainCategoryAttribute()->name,
                    'qty' => $item->qty
                ];
            });
            session()->put('order_products', $products);
            session()->put('total_product_price', CartHelper::totalProductsPriceFormatted(true));
            session()->put('total_price', CartHelper::getTotalFormatted());
            $totalPrice = CartHelper::getPaymentTotalFormatted();

            if (!$order->client_id && session()->has('temp_user')) {
                $newClient           = session()->get('temp_user');
                $newClient->order_id = $order->id;
                $newClient->save();
                $order->temp_client_id = $client->id;
                $order->save();
            }

            session()->put('order_id', $order->unique_id);
            session()->put('order_status', $order_status);
            Cart::destroy();
            CartHelper::refreshCartBD();

            session()->forget('temp_user');

            if ($client instanceof Client) {
                event(new OrderCreatedEvent($client, $order));
            } else {
                event(new OrderCreatedNoAuthEvent($client, $order));
            }

            if ($payment->type->is(PaymentType::PRIVAT24_BY_PART)) {
                $payParts = new PrivatPayParts(config('app.pb_payparts_id'), config('app.pb_payparts_pass'));
                $options = array(
                    'ResponseUrl' => route('frontend.callback.payparts'),
                    'RedirectUrl' => route('frontend.page', ['alias' => 'thankyou']),
                    'PartsCount' => $data['payparts_month'],
                    'OrderID' => $order->unique_id,
                    'merchantType' => 'PP',
                    'Currency' => '',
                    'ProductsList' => $productList
                );
                $payParts->setOptions($options);
                $response = $payParts->create('pay');

                if($response['state'] == 'SUCCESS') {
                    \Illuminate\Support\Facades\Log::info('PrivatPayParts SUCCESS create pay response', [$response]);
                    return redirect()->away('https://payparts2.privatbank.ua/ipp/v2/payment?token=' . $response['token'], 301);
                } else {
                    \Illuminate\Support\Facades\Log::info('PrivatPayParts ERROR create pay response', [$response]);
                    return redirect(route('frontend.page'), 301)->with('error', __('frontend.payparts_error_message', ['msg' => $response['message']]));
                }
            }

            if ($payment->type->is(PaymentType::LIQPAY)) {
                return redirect(route('frontend.payment_page', [$payment, $order]), 301);
            }

            if ($payment->type->is(PaymentType::PRIVAT24)) {
                return view('frontend.templates.checkout_step2.include.payment_types.privat')
                    ->with([
                        'totalPrice' => $totalPrice,
                        'unique_id' => $order->unique_id,
                        'ext_details' => $products->pluck('name')->implode(','),
                    ]);
            }

            return redirect(route('frontend.page', ['alias' => 'thankyou']), 301);
        }

        /**
         * Get payparts status for order
         *
         * @param Request $request
         *
         * @return string
         */
        public function payparts(Request $request)
        {
            \Illuminate\Support\Facades\Log::info('PrivatPayParts CALLBACK: ', [$request->all()]);
            $payParts = new PrivatPayParts(config('app.pb_payparts_id'), config('app.pb_payparts_pass'));

            $sign = $payParts->checkCallBack($request->getContent());
            if ($sign) {
                $data = $payParts->decodeParams($request->getContent());
                \Illuminate\Support\Facades\Log::info('PrivatPayParts CALLBACK DATA: ', [$data]);
                if (isset($data['orderId']) && $data['orderId'] != '') {
                    $order_id = $payParts->getOrderId($data['orderId']);
                    $order = Order::whereUniqueId($order_id)->first();
                    if ($order) {
                        if($data['paymentState'] == "success") {
                            $order->comment .= __('frontend.payment_with_payparts', ['orderId' => $data['orderId'], 'accept' => $data['message']]);
                            $order_status   = OrderStatus::onlyActive()
                                ->where('position', '>', $order->order_status->position)
                                ->byPosition()
                                ->first();
                            if ($order_status) {
                                $order->order_status_id = $order_status->id;
                            }
                            $order->save();
                        } else {
                            $order->comment .= __('frontend.payment_with_payparts', ['orderId' => $data['orderId'], 'accept' => $data['message']]);
                            $order->save();
                        }
                    }
                    Log::driver('payparts')->info('Payparts feedback orderId: ' .
                        $order_id .
                        ', status: ' .
                        $data['paymentState'], $request->all());
                } else {
                    Log::driver('payparts')->error('Payparts callback error', $request->all());
                }
            } else {
                Log::driver('payparts')->error('Payparts signature failed', $request->all());
            }
        }

        /**
         * Get privat status for order
         *
         * @param Request $request
         *
         * @return string
         */
        public function privat(Request $request)
        {
            parse_str($request->payment, $data);
            if (isset($data['order']) && $data['order'] != '') {
                $sign = sha1(md5($request->payment.config('app.pb24_merchant_pass')));
                if ($sign == $request->signature) {
                    $order_id = $data['order'];
                    switch ($data['state']) {
                        case "test":
                                break;
                        case "success":
                            $order = Order::whereUniqueId($order_id)->first();
                            if ($order) {
                                $order->comment .= __('frontend.payment_with_privat24') . $data['ref'];
                                $order_status   = OrderStatus::onlyActive()
                                    ->where('position', '>', $order->order_status->position)
                                    ->byPosition()
                                    ->first();//TODO подумать о том какой статус ставить
                                if ($order_status) {
                                    $order->order_status_id = $order_status->id;
                                }
                                $order->save();
                            }
                            break;
                    }
                    Log::driver('privatPay')->info('privatPay feedback order_id: ' .
                        $order_id .
                        ', status:' .
                        $data['state'], $request->all());
                } else {
                    Log::driver('privatPay')->error('privatPay signature failed', $request->all());
                }
            } else {
                Log::driver('privatPay')->error('privatPay callback error', $request->all());
            }

            return redirect(route('frontend.page', ['alias' => 'thankyou']));
        }

        /**
         * Get liqpay status for order
         *
         * @param Request $request
         *
         * @return string
         */
        public function liqpay(Request $request)
        {
            \Log::error('liqpay callback!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!');
            $lp_api_keys = ShopHelper::lp_api_keys();
            $liqpay      = new LiqPay($lp_api_keys['lp_api_public'], $lp_api_keys['lp_api_private']);
            $data        = $liqpay->decode_params($request->data);
            if (isset($data['payment_id']) && $data['payment_id'] != '') {
                $sign =
                    base64_encode(sha1($lp_api_keys['lp_api_private'] . $request->data . $lp_api_keys['lp_api_private'],
                        1));
                if ($sign == $request->signature) {
                    $order_id = $data['order_id'];//end(explode('-', $data['order_id']));
                    switch ($data['status']) {
                    case "sandbox":
                        if (!$lp_api_keys['lp_api_sandbox']) {
                            break;
                        }
                    case "success":
                        $order = Order::whereUniqueId($order_id)->first();
                        if ($order) {
                            $order->comment .= __('frontend.payment_with_liqpay') . $data['payment_id'];
                            $order_status   = OrderStatus::onlyActive()
                                                         ->where('position', '>', $order->order_status->position)
                                                         ->byPosition()
                                                         ->first();//TODO подумать о том какой статус ставить
                            if ($order_status) {
                                $order->order_status_id = $order_status->id;
                            }
                            $order->save();
                        }
                        break;
                    }
                    Log::driver('liqpay')->info('LiqPay feedback order_id: ' .
                        $order_id .
                        ', status:' .
                        $data['status'], $request->all());
                } else {
                    Log::driver('liqpay')->error('LiqPay signature failed', $request->all());
                }
            } else {
                Log::driver('liqpay')->error('LiqPay callback error', $request->all());
            }
            return 'end';
        }

        /**
         *
         * @param Payment $payment
         * @param Order   $order
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function paymentPage(Payment $payment, Order $order)
        {
            $locale = App::getLocale();
            if ($payment->type->is(PaymentType::LIQPAY) && $order->getTotalPrice()) {
                $lp_api_keys = ShopHelper::lp_api_keys();
                $liqPay      = new LiqPay($lp_api_keys['lp_api_public'], $lp_api_keys['lp_api_private']);
                $data        = $liqPay->viewData(
                    [
                        'language'    => $locale,
                        'public_key'  => $lp_api_keys['lp_api_public'],
                        'version'     => config('app.lp_api_version'),
                        'currency'    => LiqPay::CURRENCY_UAH,
                        'action'      => 'pay',
                        'order_id'    => $order->id,
                        'amount'      => $order->getTotalPrice(),
                        'description' => __('frontend/checkout/index.payment_purpose') . ' - ' . $order->unique_id,
                        'server_url'  => route('frontend.callback.liqpay'),
                        'result_url'  => route('frontend.page', PageAlias::PAGE_THANKYOU),
                    ]
                );
                return view('frontend.templates.checkout_step2.include.payment_types.liqpay', $data);
            } else {
                return $this->redirect()->route('frontend.page', PageAlias::PAGE_THANKYOU);
            }
        }

    }
