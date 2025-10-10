<?php

namespace App\DTO;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class Pipeline extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public int $id,
        public string $url,
        public string $identifier,
        public string $name,
    )
    {
    }
}
