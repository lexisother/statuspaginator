<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    public function index()
    {
        $sites = Site::all();
        $sites->map(function (Site $site) {
            $cmsUpdates = $site->data['craft']['updates']['cms']['releases'];
            $updAvail = sizeof($cmsUpdates) > 0;

            if ($updAvail) {
                $site->updateAvailable = true;

                Arr::map($cmsUpdates, function (array $update) use ($site) {
                    if ($update['critical']) {
                        $site->criticalUpdate = true;
                    }
                });
            }
        });

        return view('index', ['sites' => $sites]);
    }
}
