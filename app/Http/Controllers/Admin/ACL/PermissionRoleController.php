<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class PermissionRoleController extends Controller
{
    protected $role, $permission;

    public function __construct(Role $role, Permission $permission) {
        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(['can:roles']);
    }

    public function permissions($id) {
        $role = $this->role->find($id);

        if (!$role) {
            return redirect()->back();
        }

        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.permissions', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function roles($idPermission) {
        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        $roles = $permission->roles()->paginate();

        return view('admin.pages.permissions.roles.role', [
            'roles' => $roles,
            'permission' => $permission,
        ]);
    }

    public function permissionsAvailable(Request $request, $id) {
        $role = $this->role->find($id);

        if (!$role) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', [
            'role' => $role,
            'permissions' => $permissions,
            'filters' => $filters,
        ]);
    }

    public function attachPermissionsRole(Request $request, $id) {
        $role = $this->role->find($id);

        if (!$role) {
            return redirect()->back();
        }

        if(!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()->with('error', 'Precisa escolher ao mesmo uma permissão.');
        }

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.permissions', $role->id);
    }

    public function detachPermissionsRole($id, $idPermission) {
        $role = $this->role->find($id);
        $permission = $this->permission->find($idPermission);

        if (!$role || !$permission) {
            return redirect()->back();
        }

        $role->permissions()->detach($permission);

        return redirect()->route('roles.permissions', $role->id);
    }
}
