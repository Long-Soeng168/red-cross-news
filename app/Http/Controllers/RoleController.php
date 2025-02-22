<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role-permission.role.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('role-permission.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', 'Role Add Successfully');
    }

    public function edit(Role $role)
    {
        // return $permission;
        return view('role-permission.role.edit', [
            'role' => $role,
        ]);
    }
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);
        return redirect('roles')->with('status', 'Update Role Successfully');
    }
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect('roles')->with('status', 'Delete Role Successfully');
    }
    public function givePermissionsToRole($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $id)
                                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                ->all();
        return view('role-permission.role.givePermissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }
    public function updatePermissionsToRole(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $permissions = $request->only('permissions');
        $role->syncPermissions($permissions);

        return redirect('/roles')->with('status', 'Update permissions successfully!');
    }
}
