<?php

namespace App\Http\Controllers;

use App\Services\BuddyService;
use App\Services\JiraService;
use Buddy\Exceptions\BuddyResponseException;
use DH\Adf\Node\Block\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use JsonException;

class WebhookController extends Controller
{
    const MR_STATE_OPENED = 1;
    const MR_STATE_CLOSED = 2;
    const MR_STATE_MERGED = 3;
    const MR_STATE_LOCKED = 4;

    /**
     * @throws BuddyResponseException
     * @throws JsonException
     */
    public function receiveGitlab(Request $request, BuddyService $buddy, JiraService $jira)
    {
        if (Request::header('x-gitlab-token', '') !== Config::get('services.gitlab.webhook_secret'))
            return $this->jsonError(
                ['message' => 'The Maze is not meant for you.'],
                ['provided_token' => Request::header('x-gitlab-token', '')]
            );

        if (Request::json('object_kind') !== 'merge_request')
            return $this->jsonError(
                ['message' => "Can't handle non merge requests."],
                ['provided_type' => Request::json('object_kind')]
            );

        $project = Request::json('project.name') ?? 'Unknown';
        $source = Request::json('object_attributes.source_branch');
        if (!$source)
            return $this->jsonError(['message' => 'No source branch found.']);

        $runId = Str::match('/updates\/run-(\d+)/', $source);
        if (!$runId)
            return $this->jsonError(
                ['message' => "This merge request doesn't originate from an update branch"],
                [
                    'project' => $project,
                    'source_branch' => $source
                ]
            );

        $state = Request::json('object_attributes.state_id');
        if ($state === self::MR_STATE_LOCKED)
            return $this->jsonError(['message' => 'Not handling MR locks.'], log: false);
        if ($state === self::MR_STATE_OPENED)
            return $this->createJiraIssue($request, $jira);
        if ($state !== self::MR_STATE_CLOSED && $state !== self::MR_STATE_MERGED)
            return $this->jsonError(
                ['message' => "The merge request state is not valid"],
                [
                    'project' => $project,
                    'mr_state' => $state
                ]
            );

        // mind you, this is extremely volatile. though, as long as this type of string is in the description
        // **at all times**, it'll be fine.
        $desc = Request::json('object_attributes.description');
        $projectName = Str::match('/Buddy Project ID: (.*?)$/m', $desc);

        if (!$projectName)
            return $this->jsonError(
                ['message' => 'No projectName found.'],
                [
                    'source_branch' => $source,
                    'desc' => $desc
                ]
            );

        $res = $buddy->listSandboxes($projectName);
        if (!$res->isOk())
            throw $buddy->getBuddyException($res);

        $body = $res->getBody();
        if (!isset($body['sandboxes'])) // not sure how the response can be "ok" and still lack sandboxes but sure.
            return $this->jsonError(['message' => 'No sandboxes property on Buddy response.']);

        if (count($body['sandboxes']) < 1)
            return $this->jsonError(['message' => 'No sandboxes found on this project']);

        $targetSandbox = collect($body['sandboxes'])
            ->filter(fn (array $s) =>
                Str::isMatch("/updates-$runId/", $s['name']) ||
                Str::isMatch("/updates-$runId/", $s['identifier'])
            )
            ->first();

        $dres = $buddy->deleteSandbox($targetSandbox['id']);
        if (!$dres->isOk() && $res->getStatusCode() === 204)
            throw $buddy->getBuddyException($dres);

        return Response::json(['message' => 'Acknowledged. Target structure has been annihilated.']);
    }

    private function createJiraIssue(Request $request, JiraService $jira)
    {
        $repoName = Request::json('repository.name');
        $mrDesc = Request::json('object_attributes.description');
        if (!$repoName)
            return $this->jsonError(['message' => 'No repository name found.']);

        $diffList = Str::match('/```\n(.*?)```/s', $mrDesc);
        $stagingLink = Str::match('/There is a staging environment available to test this MR here: (.*?)\n/s', $mrDesc);

        $jira
            ->setProjectKey(Config::get('services.jira.projectKey'))
            ->setSummary("Update - $repoName")
            ->createIssue(
                (new Document())
                    ->paragraph()
                        ->text('There is a staging environment available to test this MR ')
                        ->link('here', $stagingLink)
                        ->text('.')
                    ->end()
                    ->codeblock('arduino')
                        ->text($diffList)
                    ->end()
            )
        ;

        return Response::json(['message' => 'Thy call hath been heeded.']);
    }

    private function jsonError($data = [], $extraData = [], $status = 200, $log = true): JsonResponse
    {
        if ($log) {
            Log::error($data['message'], array_merge(
                $extraData,
                ['stack' => new \Exception($data['message'])]
            ));
        }

        return Response::json($data, $status);
    }
}
