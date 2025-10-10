<?php

namespace App\Jobs;

use App\DTO\Updateable;
use App\Services\BuddyService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class TriggerUpdate implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Updateable $updateable,
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(BuddyService $buddy): void
    {
        $project = $this->updateable->project;
        $updatePipeline = $this->updateable->pipelines->first();
        Log::info("Triggering update for $project->name (pipeline ID: $updatePipeline->id)");

        // TODO: Actual error handling :clueless:
        $buddy->triggerPipeline($project->name, $updatePipeline->id);
    }
}
