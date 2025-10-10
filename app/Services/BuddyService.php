<?php

namespace App\Services;

use App\DTO\Pipeline;
use App\DTO\Project;
use App\DTO\Updateable;
use BadMethodCallException;
use Buddy\Buddy;
use Buddy\BuddyResponse;
use Buddy\Exceptions\BuddyResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use JsonException;

class BuddyService
{
    private string $workspace;
    private Buddy $client;

    public function __construct(string $workspace = null, string $token = null)
    {
        if (!$token || !$workspace)
            throw new BadMethodCallException('Token or workspace are missing.');

        $this->workspace = $workspace;
        $this->client = new Buddy([
            'accessToken' => $token
        ]);
    }

    /**
     * @throws BuddyResponseException
     * @throws JsonException
     *
     * @returns Collection<int, Project>
     */
    public function listProjects()
    {
        $projects = $this->client->getApiProjects();
        /** @var Collection<int, Project> $ret */
        $ret = collect();

        $lastReturnedLength = 0;
        $page = 1;
        while ($lastReturnedLength <= 50) {
            $res = $projects->getProjects($this->workspace, [
                'per_page' => 50,
                'page' => $page,
                'status' => 'ACTIVE',
            ]);
            if (!$res->isOk())
                throw $this->getBuddyException($res);

            $body = $res->getBody();

            $lastReturnedLength = count($body['projects']);
            if ($lastReturnedLength === 0)
                break;

            $ret->push(...array_map(fn ($p) => Project::from($p), $body['projects']));

            if ($lastReturnedLength < 50)
                break;

            $page++;
        }

        return $ret;
    }

    /**
     * @param string $projectName
     * @return Collection<int, Pipeline>
     *
     * @throws BuddyResponseException
     * @throws JsonException
     */
    public function listProjectPipelines(string $projectName)
    {
        $pipelines = $this->client->getApiPipelines();
        $ret = $pipelines->getPipelines($this->workspace, $projectName, ['per_page' => 20]);
        if (!$ret->isOk())
            throw $this->getBuddyException($ret);

        return collect($ret->getBody()['pipelines'])
            ->map(fn ($p) => Pipeline::from($p));
    }

    public function triggerPipeline(string $projectName, int $pipelineId)
    {
        $executions = $this->client->getApiExecutions();

        return $executions->runExecution([
            'to_revision' => [
                'revision' => 'HEAD'
            ],
            'priority' => 'HIGH',
        ], $this->workspace, $projectName, $pipelineId);
    }

    public function listUpdateableProjects()
    {
        return Cache::remember('updateableProjects', now()->addWeek(), function () {
            /** @var Collection<int, Updateable> $ret */
            $ret = collect();

            foreach ($this->listProjects() as $project) {
                $pipelines = $this->listProjectPipelines($project->name)
                    ->filter(fn (Pipeline $pipeline) =>
                        $pipeline->name === 'Run Craft updates' ||
                        $pipeline->identifier === 'run-craft-updates'
                    );

                if ($pipelines->count())
                    $ret->push(new Updateable($project, $pipelines));
            }

            return $ret;
        });
    }

    public function listSandboxes(string $projectName)
    {
        return $this->client->getApiSandboxes()->listSandboxes($this->workspace, $projectName);
    }

    public function deleteSandbox(string $sandboxId)
    {
        return $this->client->getApiSandboxes()->deleteSandbox($this->workspace, $sandboxId);
    }

    final public function getBuddyException(BuddyResponse $res)
    {
        return new BuddyResponseException(
            $res->getStatusCode(),
            $res->getHeaders(),
            json_encode($res->getBody(), JSON_THROW_ON_ERROR)
        );
    }
}
