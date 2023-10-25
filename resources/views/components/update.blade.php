@props(['update'])

<div
    class="{{ $update['critical'] ? 'bg-cardbgcrit' : 'bg-cardbgalt' }} border-black border p-4"
    x-data="{ opened: false }"
>
    <div class="flex flex-row gap-4 cursor-pointer" @click="opened = !opened">
        <h2 class="text-xl">{{ $update['version'] }}</h2>
        @if($update['date'])
            <h2 class="text-xl text-subtitle">{{ Date::make($update['date'])->toDateString() }}</h2>
        @endif
    </div>
    @if($update['notes'])
        <div class="updateContainer ml-8 pt-2" x-cloak x-show="opened">
            {!! $update['notes'] !!}
        </div>
    @endif
</div>
