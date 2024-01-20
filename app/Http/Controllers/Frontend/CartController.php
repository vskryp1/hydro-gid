<?php

namespace App\Http\Controllers\Frontend;

use App;
use App\Helpers\CartHelper;
use App\Helpers\ShopHelper;
use App\Models\Order\Delivery;
use App\Models\Order\DeliveryPlace;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductWarranty;
use Form;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LisDev\Delivery\NovaPoshtaApi2;
use App\Enums\DeliveryType;
use App\Enums\PaymentType;
use Cache;
use App\Models\Order\Payment;

class CartController extends Controller
{
    /**
     * Add product to cart with special parameters
     *
     * @param Product $product
     * @param int $count
     * @param null $options
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request, Product $product, $count = 1, $options = null)
    {
        $cart_options = [];
        if (!is_null($options)) {
            $options = explode(config('app.separators.filters.filter_filter'), $options);
            foreach ($options as $option) {
                $option                   = explode(config('app.separators.filters.filter_value'), $option);
                $cart_options[$option[0]] = $option[1];
            }
        }
        if ($request->has('warranty_id')) {
            $warranty                    = ProductWarranty::findOrFail($request->warranty_id);
            $cart_options['warranty_id'] = $warranty->id;
        }
        Cart::add($product, $count, $cart_options);
        CartHelper::refreshCartBD();

        return response()->json(CartHelper::getResponsePopup());
    }

    /**
     * Update cart item
     *
     * @param $cart_id
     * @param $count
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function updateCartItem($cart_id, $count)
    {
        Cart::update($cart_id, $count);
        CartHelper::refreshCartBD();
        return response()->json(['success' => true]);
    }

    /**
     * Remove product from cart
     *
     * @param $cart_id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function removeFromCart($cart_id)
    {
        Cart::remove($cart_id);
        CartHelper::refreshCartBD();
        if (Cart::count() <= 0) {
            session()->flash(
                'alert',
                [
                    'title'   => __('frontend.empty_checkout_title'),
                    'message' => __('frontend.empty_checkout_message'),
                ]
            );
            return response()->json(['redirect' => url(config('cart.empty_redirect'))]);
        }
        return response()->json(['success' => true]);
    }

    /**
     * Remove cart
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroyCart()
    {
        Cart::destroy();
        CartHelper::refreshCartBD();
        if (Cart::count() <= 0) {
            session()->flash(
                'alert',
                [
                    'title'   => __('frontend.empty_checkout_title'),
                    'message' => __('frontend.empty_checkout_message'),
                ]
            );
            return response()->json(['redirect' => url(config('cart.empty_redirect'))]);
        }
        return response()->json(['success' => true]);
    }

    /**
     * Change delivery method for checkout
     *
     * @param Delivery $delivery
     * @param string $rendered
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function changeDelivery(Delivery $delivery, string $rendered)
    {
        session()->put('delivery', $delivery->id);
        $html           = '';
        $addresses      = collect();
        $firstAddresses = null;
        $view           = 'frontend.templates.checkout_step2.include.delivery_types.' . strtolower(
                $delivery->type->key
            );
        if (view()->exists($view) && !filter_var($rendered, FILTER_VALIDATE_BOOLEAN)) {
            $firstAddress = null;
            if (auth('web')->check()) {
                if ($delivery->type->is(DeliveryType::COURIER_NP)) {
                    $addresses    = Auth::guard('web')->user()->load('addresses.delivery_place')->addresses;
                    $firstAddress = $addresses->first();
                }
            }
            $class = 'js-' . strtolower($delivery->type->key);
            $html  = view($view, compact('class', 'delivery', 'addresses', 'firstAddress'))->render();
        }
        $deliveryPrice = $delivery->converted_price;
        $totalPrice    = CartHelper::total(true);

        return response()->json(compact('html', 'deliveryPrice', 'totalPrice'));
    }

    /**
     * select delivery place for checkout
     *
     * @param Delivery $delivery
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchDeliveryPlace(Delivery $delivery, bool $getOnlyDeliveryPlaceIds = false)
    {
        $ids = [];
        $locale         = App::getLocale();
        $is_np = false;
        $delivery_places = [];
        if ($delivery->type->is(DeliveryType::PICKUP_NP) || $delivery->type->is(DeliveryType::COURIER_NP)) {
            $ids = Delivery::whereIn('type', [DeliveryType::PICKUP_NP, DeliveryType::COURIER_NP])->pluck('id');
            $is_np = true;
        } else {
            $ids = [$delivery->id];
        }
        $deliveryQuery = DeliveryPlace::onlyActive();
        if (request()->search) {
            $deliveryQuery->whereTranslationLike('name', "%" . request()->search . "%");
        }
       if ($is_np) {
        $np = new NovaPoshtaApi2(ShopHelper::np_api_key(), $locale);
        $cities   = $np->getCities(0, request()->search);
         foreach ($cities['data'] as $city) {
            $name = $locale == 'ru' && isset($city['DescriptionRu'])
                                ? $city['DescriptionRu']
                                : $city['Description'];
            $delivery_places[] = [
                                                    'id'   => $city['Ref'],
                                                    'text' => $name,
                                                 ];
         }
       } else {
        $delivery_places = $deliveryQuery->whereIn('delivery_id', $ids)
                                         ->orderBy('is_default')
                                         ->byPosition()
                                         ->take(config('app.limits.frontend.delivery_place'))
                                         ->get()
                                         ->map(
                                             function ($item) use ($getOnlyDeliveryPlaceIds) {
                                                 return [
                                                     'id'   => $getOnlyDeliveryPlaceIds ? $item['id'] : $item['api_id'],
                                                     'text' => $item['name'],
                                                 ];
                                             }
                                         );
       }
        
        return response()->json($delivery_places);
    }

    /**
     * Nova poshta get warehouses
     *
     * @param          $name
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function novaPoshtaWarehouses($name)
    {
        $locale         = App::getLocale();
        $wareHousesInfo = Cache::tags('warehouses')->remember(
            'warehouse.' . $name,
            config('app.cache_minutes'),
            function () use ($name, $locale) {
                $np             = new NovaPoshtaApi2(ShopHelper::np_api_key(), $locale);
                $warehouses     = $np->getWarehouses($name);
                $wareHousesInfo = [];
                if (isset($warehouses['data']) && count($warehouses['data']) > 0) {
                    foreach ($warehouses['data'] as $warehouse) {
                        $wareHousesInfo['info'][$warehouse['Ref']]   = [
                            'data-phone'      => $warehouse['Phone'],
                            'data-schedule'   => json_encode($warehouse['Schedule']),
                            'data-max_weigth' => $warehouse['TotalMaxWeightAllowed'],
                            'data-longitude'  => $warehouse['Longitude'],
                            'data-latitude'   => $warehouse['Latitude'],
                        ];
                        $wareHousesInfo['select'][$warehouse['Ref']] = $warehouse['Description' . ($locale == 'ru'
                            ? 'Ru'
                            : '')];
                    }
                }
                return $wareHousesInfo;
            }
        );
        $select         = '';
        if (isset($wareHousesInfo['select'])) {
            $select = Form::select(
                'warehouse_id',
                $wareHousesInfo['select'],
                null,
                [
                    'class' => 'required form-control js-select-np-warehouses warehouses',
                    'required',
                ],
                $wareHousesInfo['info']
            )->toHtml();
        }

        return response()->json(
            [
                'warehouses'    => $select,
                'select2_class' => '.warehouses',
            ]
        );
    }

    /**
     *
     * @param Payment $payment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePayment(Payment $payment)
    {
        session()->put('payment', $payment->id);

        $html           = '';
        $view           = 'frontend.templates.checkout_step2.include.payment_types.' . strtolower(
                $payment->type->key
            );
        if (view()->exists($view)) {
            if ($payment->type->is(PaymentType::PRIVAT24_BY_PART)) {
                $class = 'js-' . strtolower($payment->type->key);
                $html  = view($view, compact('class', 'payment'))->render();
            }
        }

        return response()->json(
            [
                'result' => true,
                'html' => $html
            ]
        );
    }
}
