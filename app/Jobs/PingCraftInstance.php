<?php

namespace App\Jobs;

use App\Models\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

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
            $req = Http::post($site->url . '/actions/statuspaginator/status', [
                'token' => $site->token
            ]);
            File::put(storage_path() . "/$site->id.txt", $req->body());
            if ($req->status() !== 200) throw new \Exception("Status code was {$req->status()}\n  Body: {$req->body()}");
            $res = $req->json();
            if ($res === null) throw new \Exception("res for $site->id was null.\n  Status: {$req->status()}\n  Body: {$req->body()}");
        } catch(\Exception $e) {
            $this->fail($e);
            return;
        }

        $site->data = $res;
        $site->save();
    }
}
