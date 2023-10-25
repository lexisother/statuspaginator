<?php

namespace App\Providers;

use App\Services\OhDearService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class OhDearProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $token = env('OHDEAR_TOKEN');
        $ohDear = new OhDearService($token);
        $this->app->instance(OhDearService::class, $ohDear);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [OhDearService::class];
    }
}
