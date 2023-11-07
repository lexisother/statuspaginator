<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends \Illuminate\Routing\Controller
{

    public function create(Request $request) {
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

    public function edit(Request $request, int $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($pass = $request->get('password'))
            $user->password = Hash::make($pass);

        $user->save();

        return redirect("/admin/users/{$user->id}");
    }

    public function delete(Request $request, int $id) {
        User::findOrFail($id)->delete();
        return redirect('/admin/users');
    }
}
