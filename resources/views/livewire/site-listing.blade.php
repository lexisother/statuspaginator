<div>
    <div class="flex justify-center">
        <input
            wire:model.live="search"
            class="h-16 mb-10 mx-4 p-4 w-[30rem] flex-1 md:flex-none bg-cardbg border border-black shadow-md"
            placeholder="Search sites..."
        />
    </div>

    <div class="grid grid-cols-1 gap-4 mx-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
        @foreach($sites as $site)
            @if($site->data)
                <x-site-card :site="$site" />
            @endif
        @endforeach
    </div>
</div>
