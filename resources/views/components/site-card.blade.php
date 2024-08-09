@props(['site'])

<div
    class="{{ $site->criticalUpdate ? 'bg-cardbgcrit' : 'bg-cardbg' }} border-black border shadow-md p-2 min-h-[9.5rem] grid"
    x-data="{ overlayShow: false }"
>
    {{-- overlay on hover --}}
    @if ($site->data)
        <a
            href="/sites/{{ $site->id }}"
            class="flex items-center justify-center pb-12 row-start-1 col-start-1 z-10 -m-2 cursor-pointer transition-opacity bg-gradient-to-t from-gradt to-gradb"
            @mouseover="overlayShow = true" @mouseleave="overlayShow = false"
            x-cloak
            :style="{ opacity: overlayShow ? 1 : 0 }"
        >
            Show details
        </a>
    @endif

    <div class="flex flex-col row-start-1 col-start-1">
        <div class="flex flex-row justify-between flex-grow" @mouseover="overlayShow = true" @mouseleave="overlayShow = false">
            <div>
                <div class="text-lg">{{ $site->name }}</div>

                @if ($site->updateAvailable)
                    <div class="text-sm text-yellow-300">Update available!</div>
                @endif
                @if ($site->criticalUpdate)
                    <div class="text-sm text-red-500">Critical update available!</div>
                @endif
            </div>
            @if ($site->data && $site->data['meta']['rebrand']['icon'])
                <div>
                    <img src="{{ $site->data['meta']['rebrand']['icon'] }}" class="h-12" />
                </div>
            @endif
        </div>

        <div class="bg-cardbgalt z-20 h-12 -m-2 text-sm flex items-center p-2">
            @if ($site->data)
                Craft {{ $site->data['craft']['version'] }} ({{ $site->data['craft']['edition'] }})
            @else
                NO DATA
            @endif
            <div class="flex-1"></div>
            @if ($site->data)
                <x-button :to="$site->data['meta']['cpurl']">Visit</x-button>
            @endif
        </div>
    </div>
</div>
