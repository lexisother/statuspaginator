<?php

namespace App\Providers;

use App\Services\BuddyService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class BuddyProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $buddy = new BuddyService(
            Config::get('services.buddy.workspace'),
            Config::get('services.buddy.token')
        );
        $this->app->instance(BuddyService::class, $buddy);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [BuddyService::class];
    }
}
