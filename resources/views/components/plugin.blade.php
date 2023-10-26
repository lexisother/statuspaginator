@props(['plugin'])

<div class="flex flex-col mb-4">
    <div class="flex flex-row gap-4 items-center">
        <p class="text-lg font-bold">{{ $plugin['name'] }}</p>
        <p class="text-sm text-subtitle">{{ $plugin['version'] }}</p>
    </div>
    @if(!empty($plugin['description']))
        <div>
            <p>{{ $plugin['description'] }}</p>
        </div>
    @endif
    <div class="flex flex-row gap-4">
        <a class="text-accent underline underline-offset-2 decoration-blue-400" href="{{ $plugin['developer']['developerUrl'] }}">{{ $plugin['developer']['name'] }}</a>
    </div>
</div>
