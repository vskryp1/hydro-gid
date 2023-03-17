<?php

namespace App\Http\Controllers\Backend\Users;

use App\Models\Role;
use App\Http\Controllers\Controller;
use View;
use App\Http\Requests\Backend\Users\CreateRole;
use App\Models\User\Permission;

class RolesController extends Controller
{


    public function __construct()
    {
        parent::__construct();
        View::share('pagetitle', 'Roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'backend.roles.index',
            [
                'roles'      => Role::where('guard_name', 'admin')->withCount(['users', 'clients'])->get(),
                'permission' => 'roles',
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view(
            'backend.roles.create',
            [
                'permissions' => $permissions,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRole $request)
    {
        $role = Role::create(['name' => $request->name, 'active' => isset($request->active)]);
        $role->syncPermissions($request->roles);
        $role->save();
        return redirect()
            ->route('backend.roles.index')
            ->with('success', ['text' => __('backend.role_created')]);
    }


    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role        = Role::findOrFail($id);
        $role        = $role->findByName($role->name);
        $permissions = Permission::whereGuardName($role->guard_name)->get();

        return view(
            'backend.roles.edit',
            [
                'role'        => $role,
                'permissions' => $permissions,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRole $request, $id)
    {
        $role         = Role::findOrFail($id);
        $role->name   = $request->name;
        $role->active = $request->active;
        $role->save();
        $role->syncPermissions($request->roles);
        return redirect()
            ->route('backend.roles.index')
            ->with('success', ['text' => __('backend.role_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('backend.roles.index')
                         ->with('success', ['text' => __('backend.role_deleted')]);
    }
}
