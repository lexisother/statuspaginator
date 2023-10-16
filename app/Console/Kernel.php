<?php

namespace App\Console;

use App\Jobs\PingCraftInstance;
use App\Models\Site;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // TODO: Write a Job that goes over all configured URLs and fetches version data
        // $schedule->exec('echo "hiii" > test.txt')->everySecond();

        $this->scheduleCraftJobs($schedule);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    private function scheduleCraftJobs(Schedule $schedule)
    {
        $sites = Site::all();

        $sites->each(function ($site) use ($schedule) {
            $schedule->job(new PingCraftInstance($site))->everyMinute();
        });
    }
}
