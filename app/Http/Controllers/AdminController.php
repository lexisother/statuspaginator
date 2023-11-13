<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends \Illuminate\Routing\Controller
{
    public function showUsers() {
        $usersByRoles = collect();
        Role::all()->map(function($role) use ($usersByRoles) {
            $users = $role->users()->get();
            $usersByRoles->put($role->name, $users);
        });

        return view('admin.users', ['roles' => $usersByRoles]);
    }

    public function showUser(int $id) {
        if ($user = User::where('id', $id)->first()) {
            return view('admin.edit-user', ['user' => $user, 'roles' => Role::all()]);
        } else {
            abort(404);
        }
    }

    public function showRoles() {
        $rolesWithAmounts = collect();
        Role::all()->map(function($role) use ($rolesWithAmounts) {
            $amount = $role->users()->count();
            $rolesWithAmounts->put($role->name, $amount);
        });

        return view('admin.roles', ['roles' => $rolesWithAmounts]);
    }

    public function showSites() {
        return view('admin.sites');
    }
}
