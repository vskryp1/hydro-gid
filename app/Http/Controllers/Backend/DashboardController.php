<?php

    namespace App\Http\Controllers\Backend;

    use App\Helpers\ShopHelper;
    use App\Models\Client\Client;
    use App\Http\Controllers\Controller;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Http\Request;

    class DashboardController extends Controller
    {
        public function index()
        {
            $clients_count     = Client::count();
            $clients_last_week = Client::whereDate('created_at', '>=', Carbon::now()->subWeek()->toDateString())->count();
            $clients_disabled  = Client::whereIsActive(false)->count();

            return view('backend.dashboard.index', [
                'client_count'             => $clients_count,
                'clients_last_week'        => $clients_count > 0 ? round($clients_last_week * 100 / $clients_count) : 0,
                'clients_disabled'         => $clients_disabled,
                'clients_disabled_percent' => $clients_count > 0 ? round($clients_disabled * 100 / $clients_count) : 0,
            ]);
        }

        public function setLocale($locale)
        {
            if (array_key_exists($locale, ShopHelper::setting('locales', [], false))) {
                session()->put('backend_locale', $locale);
            }

            return redirect()->back();
        }

        public function clearCache()
        {
            cache()->clear();

            return redirect()->back()->with('success', __('frontend.cache_cleared'));
        }

        public function filemanager()
        {
            return view('backend.filemanager.index');
        }

        public function searchByModel(Request $request)
        {
            $result = [];

            if ($request->filled('model')) {
                $result = $request->input('model')::onlyActive()
                    ->when(
                        $request->filled('q'),
                        function(Builder $builder) use ($request) {
                            return $builder->whereTranslationLike('name', '%' . trim($request->input('q')) . '%');
                        }
                    )
                    ->when(
                        $request->filled('id'),
                        function(Builder $builder) use ($request) {
                            return $builder->where('id', '<>', $request->input('id'));
                        }
                    )
                    ->get();
            }

            return response()->json($result);
        }
    }
