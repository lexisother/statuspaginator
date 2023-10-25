<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function showSite(int $id) {
        $site = Site::where('id', $id)->first();
        if (!$site) return response('Not found', 404);

        $site->setUpdates();

        return view('site', ['site' => $site]);
    }
}
