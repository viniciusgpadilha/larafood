<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class RoleUserController extends Controller
{
    protected $user, $role;

    public function __construct(User $user, Role $role) {
        $this->user = $user;
        $this->role = $role;

        $this->middleware(['can:users']);
    }

    public function roles($idUser) {
        $user = $this->user->find($idUser);

        if (!$user) {
            return redirect()->back();
        }

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.roles', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function users($idRole) {
        $role = $this->role->find($idRole);

        if (!$role) {
            return redirect()->back();
        }

        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.user', [
            'users' => $users,
            'role' => $role,
        ]);
    }

    public function rolesAvailable(Request $request, $idUser) {
        $user = $this->user->find($idUser);

        if (!$user) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available', [
            'user' => $user,
            'roles' => $roles,
            'filters' => $filters,
        ]);
    }

    public function attachRolesUser(Request $request, $idUser) {
        $user = $this->user->find($idUser);

        if (!$user) {
            return redirect()->back();
        }

        if(!$request->roles || count($request->roles) == 0) {
            return redirect()->back()->with('error', 'Precisa escolher ao menos um cargo.');
        }

        $user->roles()->attach($request->roles);

        return redirect()->route('users.roles', $user->id);
    }

    public function detachRoleUser($id, $idRole) {
        $user = $this->user->find($id);
        $role = $this->role->find($idRole);

        if (!$user || !$role) {
            return redirect()->back();
        }

        $user->roles()->detach($role);

        return redirect()->route('users.roles', $user->id);
    }
}
