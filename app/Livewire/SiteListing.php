<?php

namespace App\Livewire;

use App\Models\Site;
use Livewire\Component;

class SiteListing extends Component
{
    public string $search = '';
    public bool $create;

    public function render()
    {
        $sites = Site::where('name', 'like', "%{$this->search}%")->get();
        $sites->map(function (Site $site) {
            $site->setUpdates();
        });

        return view('livewire.site-listing', [
            'sites' => $sites
        ]);
    }
}
