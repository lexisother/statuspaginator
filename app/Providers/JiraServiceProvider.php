<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use JiraCloud\Configuration\ArrayConfiguration;
use JiraCloud\Issue\IssueService;

class JiraServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $client = new IssueService(new ArrayConfiguration([
            'jiraHost' => Config::get('services.jira.host'),
            'jiraUser' => Config::get('services.jira.user'),
            'personalAccessToken' => Config::get('services.jira.token'),
            'cookieAuthEnabled' => false,
        ]), app(Logger::class));

        $this->app->instance(IssueService::class, $client);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides()
    {
        return [IssueService::class];
    }
}
