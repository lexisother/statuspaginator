<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

    public function register(Request $request) {
        $site = Site::where([
            'token' => $request->get('token'),
        ])->first();

        $res = Http::post($site->url . '/actions/_statuspaginator/register', [
            'token' => $request->get('token')
        ])->json();

        // HACK, I guess? For some reason inlining `name` and `timezone` while they're non-nullable breaks things.
        // Very weird.
        $site->name = $res['name'];
        $site->timezone = $res['timezone'];
        $site->save();

        return redirect("/admin/sites");
    }

    // TODO: Allow unregistering from dashboard
    public function unregister(Request $request)
    {
        Site::where('token', $request->get('token'))->delete();

        return response()->json([
            'ok' => true
        ]);
    }
}
