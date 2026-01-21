<?php

namespace App\Services;

use App\DTO\Execution;
use App\DTO\Pipeline;
use App\DTO\Project;
use App\DTO\Updateable;
use Buddy\Buddy;
use Buddy\BuddyResponse;
use Buddy\Exceptions\BuddyResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use JsonException;

class BuddyService
{
    private string $workspace;
    private Buddy $client;

    public function __construct(string $workspace = null, string $token = null)
    {
        if (!$token || !$workspace)
            return;

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
            'priority' => 'LOW',
        ], $this->workspace, $projectName, $pipelineId);
    }

    public function listPipelineRuns(string $projectName, int $pipelineId)
    {
        $executions = $this->client->getApiExecutions();
        $ret = $executions->getExecutions($this->workspace, $projectName, $pipelineId);
        if (!$ret->isOk())
            throw $this->getBuddyException($ret);

        return collect($ret->getBody()['executions'])
            ->map(fn ($execution) => Execution::from($execution));
    }

    public function listUpdateableProjects()
    {
        return Cache::remember('updateableProjects', now()->addWeek(), function () {
            /** @var Collection<int, Updateable> $ret */
            $ret = collect();

            foreach ($this->listProjects() as $project) {
                $pipeline = $this->listProjectPipelines($project->name)
                    ->first(fn (Pipeline $pipeline) =>
                        $pipeline->name === 'Run Craft updates' ||
                        $pipeline->identifier === 'run-craft-updates'
                    );
                if (!$pipeline) continue;

                $earliest = $this->listPipelineRuns($project->name, $pipeline->id)
                    ->sortBy(fn (Execution $e) => $e->finish_date, descending: true)
                    ->first();

                $ret->push(new Updateable($project, $pipeline, $earliest ?? false));
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
