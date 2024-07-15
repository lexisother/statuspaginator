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

        try {
            $res = Http::get($site->url . '/actions/statuspaginator/status');
            if ($res->status() !== 200) $this->fail("Status code was {$res->status()}\n  Body: {$res->body()}");
            $res = $res->json();
        } catch(\Exception $e) {
            $this->fail($e);
            return;
        }

        $site->data = $res;
        $site->save();
    }
}
