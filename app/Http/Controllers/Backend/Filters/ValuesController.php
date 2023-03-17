<?php

namespace App\Http\Controllers\Backend\Filters;

use App\Http\Requests\Backend\Filters\Values\SaveRequest;
use App\Models\Filters\FilterValue;
use App\Http\Controllers\Controller;
use Cache;

class ValuesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:add filters', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit filters', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete filters', ['only' => ['destroy']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($filter)
    {
        return view('backend.filters.values.create', ['filter' => $filter]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRequest $request)
    {
        $data           = $request->all();
        $data['active'] = isset($request->active);
        $data['position']   = $data['position'] ?? 0;
        $filter_values  = FilterValue::create($data);
        Cache::tags('filters')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.filters.values.edit', ['filter' => $filter_values->filter_id, 'value' => $filter_values])
                : route('backend.filters.edit', ['filter' => $filter_values->filter_id]) . '#value'
        )->with('success', ['text' => __('backend.filter_value_created')]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $filter
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($filter, $value)
    {
        return view('backend.filters.values.edit', [
            'filter_value' => FilterValue::findOrFail($value),
            'filter'       => $filter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaveRequest $request
     * @param             $filter
     * @param             $value
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveRequest $request, $filter, $value)
    {
        $data           = $request->all();
        $data['active'] = isset($request->active);
        FilterValue::findOrFail($value)->update($data);
        Cache::tags('filters')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.filters.values.edit', ['filter' => $filter, 'value' => $value])
                : route('backend.filters.edit', ['filter' => $filter]) . '#value'
        )->with('success', ['text' => __('backend.filter_value_updated')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $filter
     * @param $value
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($filter, $value)
    {
        FilterValue::destroy($value);
        Cache::tags('filters')->flush();
        return redirect(route('backend.filters.edit', ['filter' => $filter]) . '#value')
            ->with('success', ['text' => __('backend.filter_value_deleted')]);
    }
}
