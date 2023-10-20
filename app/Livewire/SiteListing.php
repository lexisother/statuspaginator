<?php

namespace App\Livewire;

use App\Models\Site;
use Livewire\Component;

class SiteListing extends Component
{
    public string $search = '';

    public function render()
    {
        return view('livewire.site-listing', [
            'sites' => Site::where('name', 'like', "%{$this->search}%")->get()
        ]);
    }
}
