<?php

namespace App\Services;

use Illuminate\Support\Facades\Date;
use OhDear\PhpSdk\OhDear;
use OhDear\PhpSdk\Resources\Site;

class OhDearService {
    private OhDear $client;
    /** @var Site[] $sites */
    private array $sites;

    public function __construct(string $token)
    {
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
}
