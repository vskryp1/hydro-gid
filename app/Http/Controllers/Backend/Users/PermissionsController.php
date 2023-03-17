<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use App\Models\User\Permission;
use App\Http\Requests\Backend\Users\CreatePermission;

class PermissionsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list permissions', ['only' => ['index']]);
        $this->middleware('permission:add permissions', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit permissions', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete permissions', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.permissions.index', [
            'permissions' => Permission::all(),
            'permission'  => 'permissions',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePermission $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermission $request)
    {
        $permissions = Permission::create(['name' => $request->name]);

        return redirect()
            ->route('backend.permissions.index')
            ->with('success', ['text' => __('backend.permission_created')]);
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
        return view('backend.permissions.edit', [
            'permission' => Permission::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreatePermission $request
     * @param  int              $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePermission $request, $id)
    {
        $permission       = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()
            ->route('backend.permissions.index')
            ->with('success', ['text' => __('backend.permission_updated')]);
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
        Permission::destroy($id);
        return redirect()->route('backend.permissions.index')
            ->with('success', ['text' => __('backend.permission_deleted')]);

    }
}
