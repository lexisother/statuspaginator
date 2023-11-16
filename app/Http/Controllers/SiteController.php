<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteController extends \Illuminate\Routing\Controller
{
    public function showCreate() {
        return view('admin.create-site');
    }

    public function create(Request $request) {
        $url = $request->get('url');
        $token = Str::random(180);

        $site = Site::where('url', $url)->first();
        if ($site) return view('admin.create-site', ['exists' => true]);

        $site = new Site(['url' => $url]);
        $site->token = $token;
        $site->save();

        return view('admin.create-site', ['token' => $token]);
    }
}
