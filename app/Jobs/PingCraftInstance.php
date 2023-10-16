<?php

namespace App\Jobs;

use App\Models\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PingCraftInstance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Site $site
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $site = $this->site;

        $res = Http::get($site->url . '/actions/_statuspaginator/status')->json();
        $data = json_encode($res);
        $site->data = $data;

        $site->save();
    }
}
