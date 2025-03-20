<?php

namespace App\Livewire;

use App\Models\Site;
use Composer\Semver\Semver;
use Illuminate\Support\Collection;
use Livewire\Component;

class SiteListing extends Component
{
    public string $search = '';
    public string $constraint = '';
    public bool $create;

    public function render()
    {
        /** @var Collection<Site> $sites */
        $sites = Site::where('name', 'like', "%{$this->search}%")->get();
        $sites->map(function (Site $site) {
            $site->setUpdates();
        });

        if ($this->constraint !== "") {
            $sites = $sites->filter(function (Site $site) {
                return Semver::satisfies($site->data['craft']['version'], $this->constraint);
            });
        }


        return view('livewire.site-listing', [
            'sites' => $sites
        ]);
    }
}
