<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function createUser(Request $request) {
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        $role = $request->get('role');

        /** @var User $user */
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        $user->save();
        $user->assignRole($role);

        return redirect('/admin/users');
    }
}
