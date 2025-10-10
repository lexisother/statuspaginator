<?php

namespace App\DTO;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

enum ProjectStatus: string
{
    case ACTIVE = 'ACTIVE';
    case CLOSED = 'CLOSED';
}

class Project extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public string $url,
        public string $html_url,
        public string $name,
        public string $display_name,
        public ProjectStatus $status,
    )
    {
    }
}
