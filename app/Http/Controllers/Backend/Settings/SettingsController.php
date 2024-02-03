<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Requests\Backend\SettingsRequest;
use App\Models\SettingModel;
use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class SettingsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list settings', ['only' => ['index']]);
        $this->middleware('permission:add settings', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit settings', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete settings', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    $settings = SettingModel::actual()->settingByLocale(app()->getLocale())->orderBy('key')->get()->groupBy('key');

        return view('backend.settings.index', [
            'settings' => $settings,
            'permission' => 'settings',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.settings.create');
    }

    /**
     * @param SettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SettingsRequest $request)
    {
        $key = Str::slug($request->key);
        if($key != '') {
            \Setting::set($key, $request->value);
            foreach (\Setting::get('locales') as $lang => $value) {
                if (!empty($request->values[$lang])) {
                    \Setting::lang($lang)->set($key, $request->values[$lang]);
                }
            }

            SettingModel::where('key', $key)->update(['can_delete' => isset($request->can_delete)]);
        }
        //Artisan::command('queue:restart');
        Cache::tags('settings')->flush();
        return redirect()
            ->route('backend.settings.global.index')
            ->with('success', ['text' => __('backend.setting_saved')]);
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
        return view('backend.settings.edit', [
            'key' => $id,
        ]);
    }


    /**
     * @param SettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingsRequest $request)
    {
        \Setting::set($request->global, $request->value);
        foreach (\Setting::get('locales') as $lang => $value) {
            if ($request->values[$lang] != '') {
                \Setting::lang($lang)->set($request->global, $request->values[$lang]);
            }
        }
        Artisan::command('queue:restart');
        Cache::tags('settings')->flush();
        return redirect($request->get('action') == 'continue'
			? route('backend.settings.global.edit', ['id' => $request->key])
			: route('backend.settings.global.index'))
            ->with('success', ['text' => __('backend.setting_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $key
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        SettingModel::where('key', $key)->where('can_delete', 1)->delete();
        Cache::tags('settings')->flush();
        return redirect()
            ->route('backend.settings.global.index')
            ->with('success', ['text' => __('backend.setting_deleted')]);
    }

}
