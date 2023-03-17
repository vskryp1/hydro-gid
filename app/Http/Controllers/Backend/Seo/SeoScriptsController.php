<?php

namespace App\Http\Controllers\Backend\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Unisharp\Setting\SettingFacade;

class SeoScriptsController extends Controller
{
    /**
     * Display scripts
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function index()
    {
        $head      = SettingFacade::get('seo-head', '');
        $afterHead = SettingFacade::get('seo-afterHead', '');
        $footer    = SettingFacade::get('seo-footer', '');

        return view('backend.seo-scripts.index', [
            'head'      => $head,
            'afterHead' => $afterHead,
            'footer'    => $footer,
        ]);
    }

    /** Update scripts
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(Request $request)
    {
        SettingFacade::set('seo-head',$request->head);
        SettingFacade::set('seo-afterHead',$request->afterHead);
        SettingFacade::set('seo-footer',$request->footer);
        return redirect()->back()->with('success', [ 'text' => __('backend.seo_script_updated')]);
    }


}
