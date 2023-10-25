<?php

namespace App\Services;

use Illuminate\Support\Facades\Date;
use OhDear\PhpSdk\OhDear;
use OhDear\PhpSdk\Resources\Site;

class OhDearService {
    private OhDear $client;
    /** @var Site[] $sites */
    private array $sites;

    public function __construct(string $token = null)
    {
        if (!$token) return;
        $this->client = new OhDear($token);

        $this->fetchSites();
    }

    /**
     * Fetch all sites from the Oh Dear API.
     *
     * @return void
     */
    public function fetchSites(): void
    {
        $this->sites = $this->client->sites();
    }

    /**
     * Get all cached sites.
     *
     * @return Site[]
     */
    public function getSites(): array
    {
        return $this->sites;
    }

    /**
     * Fetch some common check data.
     *
     * @param Site $site
     * @return array
     */
    public function fetchChecks(Site $site): array
    {
        $client = $this->client;
        $id = $site->id;
        $results = [];

        $start = Date::now('Europe/Amsterdam')->subMonth()->format('YmdHis');
        $end = Date::now('Europe/Amsterdam')->format('YmdHis');
        $results['uptime'] = $client->uptime($id, $start, $end, 'hour');

        return $results;
    }
}
