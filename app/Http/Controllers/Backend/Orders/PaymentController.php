<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Helpers\ShopHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Orders\Payments\PaymentRequest;
use App\Models\Order\Payment;
use App\Models\Region\Region;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function request;

/**
 * Class PaymentController
 *
 * @package App\Http\Controllers\Backend\Orders
 */
class PaymentController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list payments', ['only' => ['index']]);
        $this->middleware('permission:add payments', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit payments', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete payments', ['only' => ['destroy', 'restore']]);
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
        $payments = Payment::query()
            ->when(
                $request->has('search'),
                function(Builder $query) {
                    return $query->whereTranslationLike('name', '%' . request('search') . '%');
                }
            )
            ->orderByDesc('updated_at')
            ->paginate($request->get('limit') ?? ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination')))
            ->appends($request->all());

        return view('backend.orders.payments.index', [
            'payments'   => $payments,
            'permission' => 'payments',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $regions = Region::query()
            ->where('is_active', true)
            ->get()
            ->pluck('name', 'id');

        return view('backend.orders.payments.create', [
            'regions' => $regions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PaymentRequest $request
     *
     * @return RedirectResponse
     */
    public function store(PaymentRequest $request): RedirectResponse
    {
	    $this->resetDefaultInRegion($request);

        $payment = Payment::create($request->all());
        $payment->regions()->attach($request->get('regions'));
        Cache::tags('payments')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.payments.edit', ['uuid' => $payment->id])
                : route('backend.payments.index')
        )->with('success', ['text' => __('backend.payment_created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $uuid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $uuid)
    {
        $payment = Payment::findOrFail($uuid);
        $regions = Region::query()
            ->where('is_active', true)
            ->get()
            ->pluck('name', 'id');

        return view('backend.orders.payments.edit', [
            'payment' => $payment,
            'regions' => $regions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PaymentRequest $request
     * @param string         $uuid
     *
     * @return RedirectResponse
     */
    public function update(PaymentRequest $request, string $uuid): RedirectResponse
    {
        $payment = Payment::findOrFail($uuid);

        $this->resetDefaultInRegion($request);

        $payment->update($request->all());
        $payment->regions()->sync($request->get('regions'));
        Cache::tags('payments')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.payments.edit', ['uuid' => $payment->id])
                : route('backend.payments.index')
        )->with('success', ['text' => __('backend.payment_updated')]);
    }

	/**
	 * @param $request
	 */
	public function resetDefaultInRegion($request){
		if($request->get('is_active') && $request->get('is_default')){
			Payment::onlyActive()->whereHas('regions', function ($region) use($request){
				return $region->whereIn('id', $request->get('regions'));
			})->update(['is_default' => false]);
		}
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
        Payment::destroy($uuid);
        Cache::tags('payments')->flush();
        return redirect(route('backend.payments.index'))
            ->with('success', ['text' => __('backend.payment_deleted')]);
    }
}
