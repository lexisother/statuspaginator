<?php

namespace App\Livewire;

use App\Services\OhDearService;
use Livewire\Component;
use OhDear\PhpSdk\Resources\Site as ODSite;

class OhDearData extends Component
{
    public string $site;
    private ODSite|null $data;

    public function mount(OhDearService $ohDear): void
    {
        $sites = $ohDear->getSites();
        $this->data = collect($sites)->where('url', $this->site)->first();
    }

    public function placeholder(): string
    {
        // TODO: When in use, add a loading indicator or something here.
        return <<<'HTML'
            <div>Loading...</div>
        HTML;
    }

    public function render()
    {
        return view('livewire.oh-dear-data', ['data' => $this->data]);
    }
}
