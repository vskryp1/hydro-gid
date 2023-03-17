<?php

namespace App\Http\Controllers\Backend\Seo;


use App\Http\Controllers\Controller;

use Storage;
use Illuminate\Http\Request;

class SeoRobotsController extends Controller
{
    /**
     * Display robots.txt
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function index()
    {
        $robotsContent = "User-agent: *\nDisallow: /";
        if(Storage::disk('public')->exists('robots.txt')) {
            $robotsContent = Storage::disk('public')->get('robots.txt');
        }
        return view('backend.seo-robots.index', [
            'robotsContent' => $robotsContent,
        ]);
    }

    /** Update robots.txt
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(Request $request)
    {
        Storage::disk('public')->put('robots.txt', $request->contents);
        return redirect()->back()->with('success', [ 'text' => __('backend.robots_txt_updated')]);
    }


}
