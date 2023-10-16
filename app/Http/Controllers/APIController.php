<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }

    public function register(Request $request)
    {
        $site = Site::firstOrCreate([
            'url' => $request->get('baseUrl')
        ]);
        $site->save();

        return response()->json([
            'ok' => true
        ]);
    }
}
