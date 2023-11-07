<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends \Illuminate\Routing\Controller
{
    public function create(Request $request) {
        $name = $request->get('name');

        Role::create([
            'name' => $name
        ]);

        return redirect('/admin/roles');
    }
}
