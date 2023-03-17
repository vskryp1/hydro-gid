<?php

namespace App\Http\Controllers\Backend\Users;

use App\Enums\UserType;
use App\Http\Requests\Backend\Users\CreateRequest;
use App\Http\Requests\Backend\Users\UpdateProfileRequest;
use App\Http\Requests\Backend\Users\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use function bcrypt;
use App\Http\Controllers\Controller;
use Cache;
use function redirect;
use View;

class UsersController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        View::share('pagetitle', 'Users');
        $this->middleware('permission:list admins', ['only' => ['index', 'show']]);
        $this->middleware('permission:add admins', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit admins', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete admins', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = auth()->user()->can('delete admins')
            ? User::withTrashed()->paginate(config('limits.backend.pagination'))
            : User::paginate(config('limits.backend.pagination'));
        return view('backend.users.index', [
            'users'      => $users,
            'permission' => 'admins',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create', [
            'roles' => Role::onlyAdmin()->pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $user           = new User($request->all());
        $user->active   = $request->active;
        $user->notification = $request->notification;
        $user->password = bcrypt($request->password);
        $user->save();
        //Checking if a role was selected
        if (isset($request->role)) {
            $role = Role::find($request->role);
            $user->assignRole($role); //Assigning role to user
        }
        Cache::tags('users')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.users.edit', ['user' => $user])
                : route('backend.users.index')
        )->with('success', ['text' => __('backend.user_created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user()->can('delete admins')
            ? User::withTrashed()->findOrFail($id)
            : User::findOrFail($id);
        return view('backend.users.show', [
            'user' => $user,
        ]);
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
        $user = auth()->user()->can('delete admins')
            ? User::withTrashed()->findOrFail($id)
            : User::findOrFail($id);
        return view('backend.users.edit', [
            'user'  => $user,
            'roles' => Role::onlyAdmin()->pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->all());
        if ($user->hasRole(UserType::ROLE_SUPER_ADMIN) && (!isset($request->active) && Role::find($request->role)->name == User::SUPERADMIN)) {
            // you can`t remove last superadmin
            if (User::role(UserType::ROLE_SUPER_ADMIN)->whereActive(true)->count() == 1) {
                return back()->with(['danger' => ['text' => __('backend.cant_remove_last_admin')]]);
            }
        }
        $user->active = $request->active;
        $user->notification = $request->notification;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        if (isset($request->role)) {
            $user->syncRoles([$request->role]); //Assigning role to user
        }
        Cache::tags('users')->flush();
        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.users.edit', ['user' => $user])
                : route('backend.users.index')
        )->with('success', ['text' => __('backend.user_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        if ($user->hasRole(UserType::ROLE_SUPER_ADMIN) && is_null($user->deleted_at)) {
            // you can`t remove last superadmin
            if (User::role(UserType::ROLE_SUPER_ADMIN)->whereActive(true)->count() == 1 && $user->active == 1) {
                return back()->with(['danger' => ['text' => __('backend.cant_remove_last_admin')]]);
            }
        }
        if ($user->trashed()) {
            $user->forceDelete();
        } else {
            $user->active = false;
            $user->save();
            $user->delete();
        }
        Cache::tags('users')->flush();
        return redirect()->route('backend.users.index')->with('success', ['text' => __('backend.deleted')]);
    }

    /**
     * Restore deleted user
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $user         = User::withTrashed()->find($id);
        $user->active = true;
        $user->save();
        $user->restore();
        Cache::tags('users')->flush();
        return redirect()->route('backend.users.index')->with('success', ['text' => 'User successfully restored']);
    }

    public function profile()
    {
        return view('backend.users.profile', [
            'user'  => auth()->user(),
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->fill($request->all());

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        Cache::tags('users')->flush();
        return redirect()
            ->back()
            ->with('success', ['text' => __('backend.update_profile')]);
    }

    public static function getRoles()
    {
        return Role::where('guard_name','admin')->pluck('name')->toArray();
    }
}
