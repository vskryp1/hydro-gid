<?php

    namespace App\Http\Controllers\Backend\Users;

    use App\Helpers\ShopHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Clients\SaveFormRequest;
    use App\Models\Client\Client;
    use App\Models\Region\Region;
    use Carbon\Carbon;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use function GuzzleHttp\Promise\all;

    class ClientsController extends Controller
    {
        private $_permission = 'clients';

        public function __construct()
        {
            parent::__construct();

            $this->middleware('permission:list ' . $this->_permission, ['only' => ['index']]);
            $this->middleware('permission:add ' . $this->_permission, ['only' => ['create', 'store']]);
            $this->middleware('permission:edit ' . $this->_permission, ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete ' . $this->_permission, ['only' => ['destroy', 'restore']]);
        }

        public function index(Request $request)
        {
            $clients = Client::with(['roles'])
                ->when(
                    auth('admin')->user()->can('delete ' . $this->_permission),
                    function(Builder $builder) {
                        return $builder->withTrashed()
                            ->orderBy('deleted_at');
                    }
                )
                ->when(
                    $request->filled('search'),
                    function(Builder $builder) use ($request) {
                        $search = '%' . $request->input('search') . '%';

                        return $builder->where('first_name', 'LIKE', $search)
                            ->orWhere('email', 'LIKE', $search)
                            ->orWhere('phone', 'LIKE', $search);
                    }
                )
                ->orderByDesc('updated_at')
                ->paginate(ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination')));

            return view('backend.clients.index', [
                'clients'    => $clients,
                'permission' => $this->_permission,
            ]);
        }

        public function create()
        {
            $regions = Region::onlyActive()
                ->byPosition()
                ->get()
                ->pluck('name', 'id');

            return view('backend.clients.create', [
                'regions' => $regions,
            ]);
        }

        public function store(SaveFormRequest $request)
        {
            $client = Client::create($request->all());
            $client->email_verified_at = Carbon::now();

            if ($request->filled('password')) {
                $client->setRememberToken(Str::random(60));
                $client->password = bcrypt($request->input('password'));
                $client->save();
            }
            if ($request->filled('address')) {
                $client->updateAddress($request->only(['address']));
            }

            event(new Registered($client));

            return redirect(
                $request->input('action') === 'continue'
                    ? route('backend.clients.edit', ['client' => $client])
                    : route('backend.clients.index')
            )->with('success', ['text' => __('backend.client_created')]);
        }

        public function edit(Client $client)
        {
            if (auth('admin')->user()->can('delete ' . $this->_permission)) {
                $client->withTrashed();
            }

            $regions = Region::onlyActive()
                ->byPosition()
                ->get()
                ->pluck('name', 'id');

            return view('backend.clients.edit', [
                'client'  => $client,
                'regions' => $regions,
            ]);
        }

        public function update(SaveFormRequest $request, Client $client)
        {
            if($request->email_verify){
                $client->email_verified_at = Carbon::now();
            }

            $client->update($request->except(['address', 'email_verify']));

            if ($request->filled('password')) {
                $client->setRememberToken(Str::random(60));
                $client->password = bcrypt($request->input('password'));
                $client->save();
            }
            if ($request->filled('address')) {
                $client->updateAddress($request->only(['address']));
            }

            return redirect(
                $request->input('action') === 'continue'
                    ? route('backend.clients.edit', ['client' => $client])
                    : route('backend.clients.index')
            )->with('success', ['text' => __('backend.client_updated')]);
        }

        public function destroy($id)
        {
            $client = Client::withTrashed()->findOrFail($id);
            if ($client->trashed()) {
                $client->forceDelete();
            } else {
                $client->save(['is_active' => false]);
                $client->delete();
            }
            return redirect(route('backend.clients.index'))->with('success', ['text' => __('backend.deleted')]);
        }

        public function restore(Client $client)
        {
            if (auth('admin')->user()->can('delete ' . $this->_permission)) {
                $client->withTrashed();
            }
            $client->restore();

            return redirect()
                ->route('backend.clients.index')
                ->with('success', ['text' => __('backend.success_title')]);
        }

        public function search(Request $request)
        {
            return Client::onlyActive()
                ->where('email', 'LIKE', '%' . $request->get('q', '') . '%')
                ->orWhere('first_name', 'LIKE', '%' . $request->get('q', '') . '%')
                ->orWhere('last_name', 'LIKE', '%' .$request->get('q', ''). '%')
                ->take(10)
                ->get()
                ->map(function ($item) {
                    return [
                        'id'   => $item->id,
                        'name' => $item->name,
                    ];
                });
        }

        public function getAddresses($client)
        {
            return response()->json(Client::with(['addresses.delivery_place'])->find($client));
        }

        public function auth(Client $client)
        {
            auth('web')->logout();
            auth('web')->login($client);

            return redirect(DIRECTORY_SEPARATOR);
        }
    }
