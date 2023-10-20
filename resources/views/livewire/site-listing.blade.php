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
                <div class="{{ $site->criticalUpdate ? 'bg-cardbgcrit' : 'bg-cardbg' }} border-black border shadow-md p-2 min-h-[9.5rem] grid">
                    <div class="flex flex-col row-start-1 col-start-1">
                        <div class="flex flex-row justify-between">
                            <div>
                                <div class="text-lg">{{ $site->name }}</div>

                                @if ($site->updateAvailable)
                                    <div class="text-sm text-yellow-300">Update available!</div>
                                @endif
                                @if ($site->criticalUpdate)
                                    <div class="text-sm text-red-500">Critical update available!</div>
                                @endif
                            </div>
                            @if ($site->data['meta']['rebrand']['icon'])
                                <div>
                                    <img src="{{ $site->data['meta']['rebrand']['icon'] }}" class="h-12" />
                                </div>
                            @endif
                        </div>

                        <div class="flex-1"></div>

                        <div class="bg-cardbgalt h-12 -m-2 mt-4 text-sm flex items-center p-2">
                            Craft {{ $site->data['craft']['version'] }} ({{ $site->data['craft']['edition'] }})
                            <div class="flex-1"></div>
                            <a
                                class="bg-blurple py-1 px-6 hover:cursor-pointer"
                                href="{{ $site->data['meta']['cpurl'] }}"
                                target="_blank"
                            >Visit</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
