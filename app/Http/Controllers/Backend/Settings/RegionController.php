<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Helpers\ShopHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Regions\RegionRequest;
use App\Models\Region\Region;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use function request;

/**
 * Class RegionController
 *
 * @package App\Http\Controllers\Backend
 */
class RegionController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list regions', ['only' => ['index']]);
        $this->middleware('permission:add regions', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit regions', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete regions', ['only' => ['destroy']]);
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
        $regions = Region::query()
            ->when(
                $request->has('search'),
                function(Builder $query) {
                    return $query->whereTranslationLike('name', '%' . request('search') . '%');
                }
            )
            ->orderByDesc('updated_at')
            ->paginate($request->get('limit') ?? ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination')))
            ->appends($request->all());

        return view('backend.regions.index', [
            'regions'    => $regions,
            'permission' => 'regions',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Backend\Regions\RegionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegionRequest $request)
    {
	    $this->resetDefault($request);
        $region = Region::create($request->all());
        Cache::tags('regions')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.settings.regions.edit', ['uuid' => $region->id])
                : route('backend.settings.regions.index')
        )->with('success', ['text' => __('backend.region_creating_success_text')]);
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
        $region = Region::findOrFail($uuid);

        return view('backend.regions.edit', [
            'region' => $region,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Backend\Regions\RegionRequest $request
     * @param string                                           $uuid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RegionRequest $request, string $uuid)
    {
        $region = Region::findOrFail($uuid);

	    $this->resetDefault($request);

        $region->update($request->all());

        Cache::tags('regions')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.settings.regions.edit', ['uuid' => $region->id])
                : route('backend.settings.regions.index')
        )->with('success', ['text' => __('backend.region_updating_success_text')]);
    }

	/**
	 * @param $request
	 */
	public function resetDefault($request){
		if($request->get('is_active') && $request->get('is_default')){
			Region::onlyActive()->update(['is_default' => false]);
		}
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        Region::destroy($uuid);
        Cache::tags('regions')->flush();
        return redirect(route('backend.settings.regions.index'))
            ->with('success', ['text' => __('backend.region_removing_success_text')]);
    }
}
