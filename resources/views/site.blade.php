@extends('layouts.app')

@section('content')
    <x-pagecard>
        {{-- Header --}}
        <div class="text-center flex flex-col gap-4 justify-between items-center lg:flex-row lg:gap-0">
            <div class="flex flex-row gap-4">
                <h1 class="text-lg font-light self-center md:text-5xl">{{ $site->name }}</h1>
                <img src="{{ $site->data['meta']['rebrand']['icon'] }}" class="w-12" />
            </div>
            <div class="flex flex-col gap-2">
                <x-button :to="$site->data['meta']['cpurl']" newtab>Control Panel</x-button>
                <x-button :to="$site->url" newtab>Public Site</x-button>
                <x-button to="/sites/{{ $site->id }}/plugins">Plugin List</x-button>
            </div>
        </div>

        {{-- <livewire:oh-dear-data lazy :site="$site->url" /> --}}

        {{-- Metadata --}}
        <div class="flex flex-col gap-2">
            <h1 class="text-4xl mb-2">Info</h1>
            <p>Timezone: {{ $site->timezone }}</p>
        </div>

        {{-- Updates --}}
        <div class="flex flex-col">
            <h1 class="text-4xl mb-2">Updates</h1>
            @if($site->updateAvailable)
                <div class="flex flex-col gap-4">
                    <h2 class="text-3xl mb-1">Craft CMS</h2>
                    @foreach($site->data['craft']['updates']['cms']['releases'] as $update)
                        <x-update :update="$update" />
                    @endforeach
                    @foreach($site->data['craft']['updates']['plugins'] as $plugin)
                        @if(count($plugin['releases']) > 0)
                            <h2 class="text-3xl mb-1">{{ $plugin['name'] }}</h2>
                            @foreach($plugin['releases'] as $update)
                                <x-update :update="$update" />
                            @endforeach
                        @endif
                    @endforeach
                </div>
            @else
                <p>All up-to-date!</p>
            @endif
        </div>
    </x-pagecard>
@endsection
