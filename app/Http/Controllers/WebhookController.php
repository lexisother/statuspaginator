<?php

namespace App\Http\Controllers;

use App\Services\BuddyService;
use Buddy\BuddyResponse;
use Buddy\Exceptions\BuddyResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
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
    public function receiveGitlab(Request $request, BuddyService $buddy)
    {
        if (Request::header('x-gitlab-token', '') !== Config::get('services.gitlab.webhook_secret'))
            return $this->jsonError(['message' => 'The Maze is not meant for you.'], status: 401);

        if (Request::json('object_kind') !== 'merge_request')
            return $this->jsonError(['message' => "Can't handle non merge requests."], status: 501);

        $source = Request::json('object_attributes.source_branch');
        if (!$source)
            return $this->jsonError(['message' => 'No source branch found.'], status: 422);
        $runId = Str::match('/updates\/run-(\d+)/', $source);
        if (!$runId)
            return Response::json(['message' => "This merge request doesn't originate from an update branch: $source"], status: 422);

        $state = Request::json('object_attributes.state_id');
        if ($state === self::MR_STATE_OPENED || $state === self::MR_STATE_LOCKED)
            return $this->jsonError(['message' => 'Not handling MR opens and locks.'], status: 422, log: false);
        if ($state !== self::MR_STATE_CLOSED && $state !== self::MR_STATE_MERGED)
            return $this->jsonError(['message' => "The merge request state is not valid: $state"], status: 422);

        // mind you, this is extremely volatile. though, as long as this type of string is in the description
        // **at all times**, it'll be fine.
        $desc = Request::json('object_attributes.description');
        $projectName = Str::match('/Buddy Project ID: (.*?)$/m', $desc);

        if (!$runId || !$projectName)
            return $this->jsonError(
                ['message' => 'No runId or projectName found.'],
                [
                    'source_branch' => $source,
                    'desc' => $desc
                ],
                500);

        $res = $buddy->listSandboxes($projectName);
        if (!$res->isOk())
            throw $this->getBuddyException($res);

        $body = $res->getBody();
        if (!isset($body['sandboxes'])) // not sure how the response can be "ok" and still lack sandboxes but sure.
            return $this->jsonError(['message' => 'No sandboxes property on Buddy response.'], status: 500);

        if (count($body['sandboxes']) < 1)
            return $this->jsonError(['message' => 'No sandboxes found on this project'], status: 500);

        $targetSandbox = collect($body['sandboxes'])
            ->filter(fn (array $s) =>
                Str::isMatch("/updates-$runId/", $s['name']) ||
                Str::isMatch("/updates-$runId/", $s['identifier'])
            )
            ->first();

        $dres = $buddy->deleteSandbox($targetSandbox['id']);
        if (!$dres->isOk() && $res->getStatusCode() === 204)
            throw $this->getBuddyException($dres);

        return Response::json(['message' => 'Acknowledged. Target structure has been annihilated.']);
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

    private function getBuddyException(BuddyResponse $res)
    {
        return new BuddyResponseException(
            $res->getStatusCode(),
            $res->getHeaders(),
            json_encode($res->getBody(), JSON_THROW_ON_ERROR)
        );
    }
}
