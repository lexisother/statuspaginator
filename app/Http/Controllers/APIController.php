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
        // HACK, I guess? For some reason inlining `name` and `timezone` while they're non-nullable breaks things.
        // Very weird.
        $site = Site::where([
            'token' => $request->get('token'),
        ])->first();
        $site->name = $request->get('name');
        $site->timezone = $request->get('timezone');
        $site->save();

        return response()->json([
            'ok' => true
        ]);
    }

    public function unregister(Request $request)
    {
        Site::where('token', $request->get('token'))->delete();

        return response()->json([
            'ok' => true
        ]);
    }
}
