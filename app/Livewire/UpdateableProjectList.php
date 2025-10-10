<?php

namespace App\Livewire;

use App\DTO\Updateable;
use App\Jobs\TriggerUpdate;
use App\Services\BuddyService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class UpdateableProjectList extends Component
{
    /** @var Collection<int, Updateable> $updateables */
    public $updateables;
    public $checkedUpdateables = [];

    public function trigger(string $action)
    {
        $toUpdate = collect($this->checkedUpdateables);

        $this->updateables->each(function (Updateable $updateable) use ($action, $toUpdate) {
            if ($toUpdate->contains($updateable->project->name)) {
                $dispatch = TriggerUpdate::dispatch($updateable);
                if ($action === 'tonight') {
                    if (!App::environment('production')) {
                        $dispatch->delay(now()->addSeconds(20));
                    } else {
                        $dispatch->delay(now()->diffInSeconds(now()->endOfDay()));
                    }
                }
            }
        });
    }

    public function toggleAll()
    {
        if (count($this->checkedUpdateables)) {
            $this->checkedUpdateables = [];
            return;
        }

        $this->checkedUpdateables = $this->updateables
            ->map(fn (Updateable $u) => $u->project->name)->toArray();
    }

    public function mount(BuddyService $buddy): void
    {
        $this->updateables = $buddy->listUpdateableProjects();
    }

    public function placeholder(): string
    {
        return <<<'HTML'
        <div>
            Loading... (please be patient, this can take a while!)
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.updateable-project-list', [
            'updateables' => $this->updateables
        ]);
    }
}
