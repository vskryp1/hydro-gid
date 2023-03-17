<?php

namespace App\Http\Controllers\Backend\Seo;

use App\Models\Seo\SeoMetas;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Seo\SeoMetasRequest;

class SeoMetasController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list seo meta', ['only' => ['index']]);
        $this->middleware('permission:add seo meta', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit seo meta', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete seo meta', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.seo-metas.index', [
            'metas'      => SeoMetas::all(),
            'permission' => 'seo meta',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.seo-metas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeoMetasRequest $request)
    {
        $seoMeta = SeoMetas::create($request->all());
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.seo-metas.edit', ['seo-meta' => $seoMeta])
                : route('backend.seo-metas.index')
        )->with('success', ['text' => __('backend.seo_metatag_created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         return view('backend.seo-metas.edit', [
             'metas' => SeoMetas::findOrFail($id),
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeoMetasRequest $request, $id)
    {
        SeoMetas::findOrFail($id)->update($request->all());
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.seo-metas.edit', ['seo-meta' => $id])
                : route('backend.seo-metas.index')
        )->with('success', ['text' => __('backend.seo_metatag_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SeoMetas::destroy($id);
        return redirect()->route('backend.seo-metas.index')->with('success', [ 'text' => __('backend.seo_metatag_deleted')]);
    }
}
