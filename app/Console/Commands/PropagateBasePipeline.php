<?php

namespace App\Console\Commands;

use App\Services\BuddyService;
use Illuminate\Console\Command;

class PropagateBasePipeline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:propagate-base-pipeline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy the base pipeline YAML over to all other updateable projects';

    /**
     * Execute the console command.
     */
    public function handle(BuddyService $buddy)
    {
        $buddy->propagateBasePipeline();
    }
}
