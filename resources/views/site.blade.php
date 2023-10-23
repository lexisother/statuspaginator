@extends('layouts.app')

@section('content')
    <div class="bg-cardbg border-black border shadow-md m-4 min-h-[9.5rem] grid">
        {{-- Header --}}
        <div class="m-10 text-center flex flex-row justify-between items-center">
            <div class="flex flex-row gap-4">
                <h1 class="text-5xl text-hero font-light">{{ $site->name }}</h1>
                <img src="{{ $site->data['meta']['rebrand']['icon'] }}" class="w-12" />
            </div>
            <div class="flex flex-col gap-2">
                <a
                    class="bg-blurple py-1 px-6 hover:cursor-pointer"
                    href="{{ $site->data['meta']['cpurl'] }}"
                    target="_blank"
                >Control Panel</a>
                <a
                    class="bg-blurple py-1 px-6 hover:cursor-pointer"
                    href="{{ $site->url }}"
                    target="_blank"
                >Public Site</a>
            </div>
        </div>

        {{-- Metadata --}}
        <div class="flex flex-col gap-2 mx-10 mb-10">
            <h1 class="text-3xl mb-2">Info</h1>
            <p>Timezone: {{ $site->timezone }}</p>
        </div>

        {{-- Updates --}}
        <div class="flex flex-col mx-10 mb-10">
            <h1 class="text-3xl mb-2">Updates</h1>
            @if($site->updateAvailable)
                <div class="flex flex-col gap-4">
                    @foreach($site->data['craft']['updates']['cms']['releases'] as $update)
                        <div
                            class="{{ $update['critical'] ? 'bg-cardbgcrit' : 'bg-cardbgalt' }} border-black border p-4"
                            x-data="{ opened: false }"
                        >
                            <div class="flex flex-row gap-4 cursor-pointer" @click="opened = !opened">
                                <h2 class="text-xl">{{ $update['version'] }}</h2>
                                <h2 class="text-xl text-subtitle">{{ Date::make($update['date'])->toDateString() }}</h2>
                            </div>
                            <div class="updateContainer ml-8 pt-2" x-cloak x-show="opened">
                                {!! $update['notes'] !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>All up-to-date!</p>
            @endif
        </div>
    </div>
@endsection
