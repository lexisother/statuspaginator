<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends \Illuminate\Routing\Controller
{
    public function showUsers() {
        /** @var User $user */
        $user = Auth::user();

        $usersByRoles = collect();
        Role::all()->map(function($role) use ($usersByRoles) {
            $users = $role->users()->get();
            $usersByRoles->put($role->name,  $users);
        });

        if ($user->hasRole('admin'))
            return view('admin.users', ['roles' => $usersByRoles]);
        else
            abort(403);
    }
}
