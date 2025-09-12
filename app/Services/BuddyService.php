<?php

namespace App\Services;

use Buddy\Buddy;

class BuddyService
{
    private string $workspace;
    private Buddy $client;

    public function __construct(string $workspace = null, string $token = null)
    {
        if (!$token || !$workspace) return;

        $this->workspace = $workspace;
        $this->client = new Buddy([
            'accessToken' => $token
        ]);
    }

    public function listSandboxes(string $projectName)
    {
        $sandboxes = $this->client->getApiSandboxes();

        return $sandboxes->listSandboxes($this->workspace, $projectName);
    }

    public function deleteSandbox(string $sandboxId)
    {
        $sandboxes = $this->client->getApiSandboxes();

        return $sandboxes->deleteSandbox($this->workspace, $sandboxId);
    }
}
