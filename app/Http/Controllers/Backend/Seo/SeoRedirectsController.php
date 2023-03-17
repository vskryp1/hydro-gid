<?php

namespace App\Http\Controllers\Backend\Seo;

use App\Models\Seo\SeoRedirects;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Seo\SeoRedirectsRequest;

class SeoRedirectsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list seo redirects', ['only' => ['index']]);
        $this->middleware('permission:add seo redirects', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit seo redirects', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete seo redirects', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.seo-redirects.index', [
            'redirects'  => SeoRedirects::all(),
            'permission' => 'seo redirects',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.seo-redirects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SeoRedirectsRequest $request)
    {
        $seoRedirect = SeoRedirects::create($request->all());
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.seo-redirects.edit', ['seo-redirect' => $seoRedirect])
                : route('backend.seo-redirects.index')
        )->with('success', ['text' => __('backend.redirect_created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.seo-redirects.edit', [
            'redirect' => SeoRedirects::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SeoRedirectsRequest $request, $id)
    {
        SeoRedirects::findOrFail($id)->update($request->all());
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.seo-redirects.edit', ['seo-redirect' => $id])
                : route('backend.seo-redirects.index')
        )->with('success', ['text' => __('backend.redirect_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SeoRedirects::destroy($id);
        return redirect()->route('backend.seo-redirects.index')
            ->with('success', ['text' => __('backend.redirect_deleted')]);
    }
}
