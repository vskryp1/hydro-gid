<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Helpers\ShopHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Orders\Deliveries\DeliveryRequest;
use App\Jobs\ConvertPriceJob;
use App\Models\Currency\Currency;
use App\Models\Order\Delivery;
use App\Models\Order\DeliveryPlace;
use App\Models\Region\Region;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function request;

/**
 * Class DeliveryController
 *
 * @package App\Http\Controllers\Backend\Orders
 */
class DeliveryController extends Controller
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
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $deliveries = Delivery::query()
            ->when(
                $request->has('search') && $request->search != '',
                function(Builder $query) {
                    return $query->whereTranslationLike('name', '%' . request('search') . '%');
                }
            )
            ->orderByDesc('updated_at')
            ->paginate($request->get('limit') ?? ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination')))
            ->appends($request->all());

        return view('backend.orders.deliveries.index', [
            'deliveries' => $deliveries,
            'permission' => 'deliveries',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.orders.deliveries.create', [
            'currencies_list'  => Currency::onlyActive()->byDefault()->get()->pluck('full_name', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DeliveryRequest $request
     *
     * @return RedirectResponse
     */
    public function store(DeliveryRequest $request): RedirectResponse
    {
        $delivery = Delivery::create($request->all());

        dispatch(new ConvertPriceJob(ShopHelper::default_currency(), collect([$delivery]), ['price']));
        Cache::tags('deliveries')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.deliveries.edit', ['uuid' => $delivery->id])
                : route('backend.deliveries.index')
        )->with('success', ['text' => __('backend.delivery_created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $uuid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, string $uuid)
    {
        $delivery_places = DeliveryPlace::when(
            $request->has('search'),
            function(Builder $query) {
                return $query->whereTranslationLike('name', '%' . request('search') . '%');
            }
        )->byPosition()->whereDeliveryId($uuid);
        return view('backend.orders.deliveries.edit', [
            'delivery' => Delivery::findOrFail($uuid),
            'delivery_places'  => $delivery_places->paginate(ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination'))),
            'currencies_list'  => Currency::onlyActive()->byDefault()->get()->pluck('full_name', 'id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DeliveryRequest $request
     * @param string          $uuid
     *
     * @return RedirectResponse
     */
    public function update(DeliveryRequest $request, string $uuid): RedirectResponse
    {
        $delivery = Delivery::findOrFail($uuid);

        $delivery->update($request->all());

        dispatch(new ConvertPriceJob(ShopHelper::default_currency(), collect([$delivery]), ['price']));
        Cache::tags('deliveries')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.deliveries.edit', ['uuid' => $delivery->id])
                : route('backend.deliveries.index')
        )->with('success', ['text' => __('backend.delivery_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $uuid): RedirectResponse
    {
        Delivery::destroy($uuid);
        Cache::tags('deliveries')->flush();
        return redirect(route('backend.deliveries.index'))
            ->with('success', ['text' => __('backend.delivery_deleted')]);
    }
}
