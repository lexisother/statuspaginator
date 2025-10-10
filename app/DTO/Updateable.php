<?php

namespace App\DTO;

use App\DTO\Pipeline;
use App\DTO\Project;
use Illuminate\Support\Collection;
use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class Updateable extends Data implements Wireable
{
    use WireableData;

    /**
     * @param Project $project
     * @param Collection<int, Pipeline> $pipelines
     */
    public function __construct(
        public Project $project,
        public Collection $pipelines,
    )
    {
    }
}
