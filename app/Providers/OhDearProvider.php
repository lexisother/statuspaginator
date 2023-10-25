<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OhDear\PhpSdk\OhDear;

class OhDearProvider extends ServiceProvider
{
    public function boot() {
        $token = env('OHDEAR_TOKEN');
        $ohDear = new OhDear($token);
        $this->app->instance(OhDear::class, $ohDear);
    }
}
