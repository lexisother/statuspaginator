<?php

namespace App\Console\Commands;

use App\Jobs\PingCraftInstance;
use App\Models\Site;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

class CreateSiteJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-site-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually dispatch queue jobs to fetch site data.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sites = Site::all();
        $sites->each(function ($site) {
            dispatch(new PingCraftInstance($site));
        });

        return self::SUCCESS;
    }
}
