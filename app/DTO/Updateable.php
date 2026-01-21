<?php

namespace App\DTO;

use App\DTO\Pipeline;
use App\DTO\Project;
use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class Updateable extends Data implements Wireable
{
    use WireableData;

    /**
     * @param Project $project
     * @param Pipeline $pipeline
     * @param Execution|false $lastExecution
     */
    public function __construct(
        public Project $project,
        public Pipeline $pipeline,
        public Execution|false $lastExecution = false,
    )
    {
    }

    public function wasRanRecently(): bool
    {
        if (!$this->lastExecution) return false;
        return $this->lastExecution->finish_date->diffInMonths(now()) < 1;
    }
}
