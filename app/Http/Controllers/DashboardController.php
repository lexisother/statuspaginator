<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $sites = Site::all();

        return view('index', ['sites' => $sites]);
    }
}
