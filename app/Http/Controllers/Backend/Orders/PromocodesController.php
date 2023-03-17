<?php

    namespace App\Http\Controllers\Backend\Orders;

    use App\Helpers\ShopHelper;
    use App\Http\Requests\Backend\Products\PromocodeRequest;
    use App\Jobs\ConvertPriceJob;
    use App\Models\Currency\Currency;
    use App\Models\Product\Promocode;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    class PromocodesController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:list promocodes', ['only' => ['index']]);
            $this->middleware('permission:add promocodes', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit promocodes', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete promocodes', ['only' => ['destroy']]);
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
            $promocodes = Promocode::query();

            return view('backend.promocodes.index', [
                'promocodes' => $promocodes->paginate($request->get('limit',
                    ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination', 25)))),
                'permission' => 'promocodes',
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('backend.promocodes.create', [
                'currencies_list' => Currency::onlyActive()->byDefault()->get()->pluck('full_name', 'id')->toArray(),
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(PromocodeRequest $request)
        {
            $discount_size                  = str_replace(',', '.',
                (!empty($request->original_discount_size)) ? $request->original_discount_size : 0);
            $data['active']                 = isset($request->active);
            $data['currency_id']            = $request->currency_id;
            $data['type']                   = $request->type;
            $data['original_discount_size'] = $discount_size;
            $data['discount_size']          = $discount_size;
            $data['use_count']              = (!empty($request->use_count)) ? $request->use_count : 0;
            $data['type_of_use']            = isset($request->type_of_use);
            $data['expiration_date']        = Carbon::parse($request->expiration_date)->format('Y-m-d');
            $data['alias']                  = ($request->alias) ? $request->alias : config('default_promocode_name',
                    'PROMOCODE') . Promocode::count();
            $promocode                      = Promocode::create($data);

            if ($request->type == Promocode::AMOUNT) {
                dispatch(new ConvertPriceJob(ShopHelper::default_currency(), collect([$promocode]), ['discount_size']));
            }
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.promocodes.edit', ['promocode' => $promocode])
                    : route('backend.promocodes.index')
            )->with('success', ['text' => __('backend.promocode_created')]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  Promocode $promocode
         *
         * @return \Illuminate\Http\Response
         */
        public function edit(Promocode $promocode)
        {
            $orders    = $promocode->orders()->with([
                'order_status',
                'currency',
                'products.translations',
                'user',
                'client'
            ])->orderBy('created_at', 'desc')->paginate(500);

            return view('backend.promocodes.edit', [
                'promocode'       => $promocode,
                'orders'          => $orders,
                'currencies_list' => Currency::onlyActive()->byDefault()->get()->pluck('full_name', 'id')->toArray(),
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
        public function update(PromocodeRequest $request, $promocode)
        {
            $promocode = Promocode::findOrFail($promocode);

            $data['active']                 = isset($request->active);
            $data['type']                   = $request->type;
            $data['currency_id']            = $request->currency_id;
            $data['original_discount_size'] = (!empty($request->original_discount_size)) ? $request->original_discount_size : 0;
            $data['use_count']              = (!empty($request->use_count)) ? $request->use_count : 0;
            $data['type_of_use']            = isset($request->type_of_use);
            $data['expiration_date']        = Carbon::parse($request->expiration_date)->format('Y-m-d');
            $data['alias']                  = ($request->alias) ? $request->alias : config('default_promocode_name',
                    'PROMOCODE') . Promocode::count();
            $promocode->update($data);

            if ($request->type == Promocode::AMOUNT) {
                dispatch(new ConvertPriceJob(ShopHelper::default_currency(), collect([$promocode]), ['discount_size']));
            }
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.promocodes.edit', ['promocode' => $promocode])
                    : route('backend.promocodes.index')
            )->with('success', ['text' => __('backend.promocode_updated')]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  string $filter
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($promocode)
        {
            Promocode::destroy($promocode);
            return redirect(route('backend.promocodes.index'))->with('success',
                ['text' => __('backend.promocode_deleted')]);
        }
    }
