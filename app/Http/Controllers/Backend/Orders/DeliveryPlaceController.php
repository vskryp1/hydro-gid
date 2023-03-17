<?php

    namespace App\Http\Controllers\Backend\Orders;

    use App\Helpers\ShopHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Orders\Deliveries\DeliveryPlaceRequest;
    use App\Jobs\ConvertPriceJob;
    use App\Models\Order\Delivery;
    use App\Models\Order\DeliveryPlace;
    use Cache;
    use function request;

    /**
     * Class RegionController
     *
     * @package App\Http\Controllers\Backend
     */
    class DeliveryPlaceController extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:list deliveries', ['only' => ['index']]);
            $this->middleware('permission:add deliveries', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit deliveries', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete deliveries', ['only' => ['destroy', 'restore']]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @param $delivery
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create($delivery)
        {
            return view('backend.orders.deliveries.places.create', ['delivery' => $delivery]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  DeliveryPlaceRequest $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(DeliveryPlaceRequest $request)
        {
            $data               = $request->all();
            $data['is_active']  = isset($request->is_active);
            $data['is_default'] = isset($request->is_default);

            $delivery_place = DeliveryPlace::create($data);
            $delivery = Delivery::find($delivery_place->delivery_id);

            dispatch(new ConvertPriceJob(ShopHelper::default_currency(), collect([$delivery_place]), ['price'], $delivery->currency));
            Cache::tags('deliveries')->flush();
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.deliveries.delivery_places.edit',
                    ['delivery' => $delivery, 'delivery_place' => $delivery_place])
                    : route('backend.deliveries.edit',
                        ['delivery' => $delivery]) . '#delivery_places'
            )->with('success', ['text' => __('backend.delivery_place_created')]);
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param $delivery
         * @param $delivery_place
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit($delivery, $delivery_place)
        {
            return view('backend.orders.deliveries.places.edit', [
                'delivery_place' => DeliveryPlace::findOrFail($delivery_place),
                'delivery'       => $delivery,
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param DeliveryPlaceRequest   $request
         * @param                        $delivery
         * @param                        $delivery_place
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(DeliveryPlaceRequest $request, $delivery, $delivery_place)
        {
            $delivery = Delivery::find($delivery);

            $data           = $request->all();
            $data['is_active']  = isset($request->is_active);
            $data['is_default'] = isset($request->is_default);

            $delivery_place = DeliveryPlace::findOrFail($delivery_place);
            $delivery_place->update($data);

            dispatch(new ConvertPriceJob(ShopHelper::default_currency(), [$delivery_place], ['price'], $delivery->currency));
            Cache::tags('deliveries')->flush();
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.deliveries.delivery_places.edit',
                    ['delivery' => $delivery, 'delivery_place' => $delivery_place])
                    : route('backend.deliveries.edit', ['delivery' => $delivery]) . '#delivery_places'
            )->with('success', ['text' => __('backend.delivery_place_updated')]);

        }

        /**
         * Remove the specified resource from storage.
         *
         * @param $delivery
         * @param $delivery_place
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy($delivery, $delivery_place)
        {
            DeliveryPlace::destroy($delivery_place);
            Cache::tags('deliveries')->flush();
            return redirect(route('backend.deliveries.edit', ['delivery' => $delivery]) . '#delivery_places')
                ->with('success', ['text' => __('backend.delivery_place_deleted')]);
        }
    }
