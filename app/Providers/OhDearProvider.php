<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use OhDear\PhpSdk\OhDear;

class OhDearProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $token = env('OHDEAR_TOKEN');
        $ohDear = new OhDear($token);
        $this->app->instance(OhDear::class, $ohDear);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [OhDear::class];
    }
}
