<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = FacadesRequest::input('search');

        return Inertia::render('Role/Index', [
            'roles' => Role::select('roles.*', 'portfolios.name as portfolio_name')
                ->leftJoin('portfolios', 'portfolios.id', 'roles.portfolio_id')
                ->whereNot('roles.id', 1)
                ->when($filter, function ($query, $filter) {
                    $query->where('roles.name', 'LIKE', '%'.$filter.'%');
                })
                ->paginate(10),
            'filters' => FacadesRequest::all('search', 'trashed'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();

        return Inertia::render('Role/Create', [
            'permissions' => Permission::get(),
            'portfolios' => Portfolio::pluck('name', 'id')->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,portfolio_id',
            'portfolio' => 'required|unique:roles,name,portfolio_id',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name'), 'portfolio_id' => $request->input('portfolio')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('message', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(($id == 1), 403);
        $role = Role::select('roles.*', 'portfolios.name as portfolio_name')->leftJoin('portfolios', 'portfolios.id', 'roles.portfolio_id')->find($id);
        $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_has_permissions.role_id', $id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(($id == 1), 404);

        return Inertia::render('Role/Edit', [
            'role' => Role::select('roles.*', 'portfolios.name as portfolio_name')
                ->leftJoin('portfolios', 'portfolios.id', 'roles.portfolio_id')
                ->find($id),
            'permissions' => Permission::get(),
            'rolePermissions' => DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(($id == 1), 404);

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('message', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(($id == 1), 404);

        DB::table('roles')->where('id', $id)->delete();

        return redirect()->route('roles.index')
            ->with('message', 'Role deleted successfully');
    }
}
