<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AdminController extends \Illuminate\Routing\Controller
{
    public function showDashboard() {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasRole('admin'))
            return view('admin.dash');
        else
            abort(403);
    }
}
