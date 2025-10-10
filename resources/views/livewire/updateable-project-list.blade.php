<div>
    <button
        class="flex items-center justify-center space-x-2 bg-blurple py-1 px-6 hover:cursor-pointer"
        wire:click="toggleAll"
    >
        Toggle all
    </button>

    <div class="grid grid-cols-2 my-4">
        @foreach($updateables as $updateable)
            <div class="flex flex-row gap-2">
                <input
                    id="{{ $updateable->project->name }}"
                    type="checkbox"
                    value="{{ $updateable->project->name }}"
                    wire:model="checkedUpdateables"
                />
                <label for="{{ $updateable->project->name }}">{{ $updateable->project->display_name }}</label>
            </div>
        @endforeach
    </div>

    <div class="flex flex-row gap-2">
        <button
            class="flex flex-grow items-center justify-center space-x-2 bg-blurple py-1 px-6 hover:cursor-pointer mb-4"
            wire:click="trigger('tonight')"
        >
            Tonight
        </button>
        <button
            class="flex flex-grow items-center justify-center space-x-2 bg-red-800 py-1 px-6 hover:cursor-pointer mb-4"
            wire:click="trigger('now')"
        >
            Now
        </button>
    </div>
</div>
