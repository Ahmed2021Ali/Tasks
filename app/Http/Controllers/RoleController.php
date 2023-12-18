<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $permission = Permission::get();
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('roles.index', compact('roles', 'permission'));
    }

    public function store(StoreRoleRequest $request)
    {
        $validatedData=$request->validated();
        $role = Role::create(['name'=>$validatedData['name']]);
        if ($validatedData['permission']) {
            $role->syncPermissions($validatedData['permission']);
        }
        return redirect()->route('role.index')->with('success', 'Role created successfully');
    }

    public function show(Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function update(UpdateRoleRequest $request,Role $role)
    {
        $validatedData=$request->validated();
        $role->update(['name'=>$validatedData['name']]);
        $role->syncPermissions($validatedData['permission']);
        return redirect()->route('role.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully');
    }


}
