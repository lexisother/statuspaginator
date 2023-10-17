@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 gap-4 mx-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
        @foreach($sites as $site)
            @if($site->data)
                <div class="bg-cardbg border-black border shadow-md p-2 min-h-[9.5rem] grid">
                    <div class="flex flex-col row-start-1 col-start-1">
                        <div class="text-lg">{{ $site->name }}</div>
                        <div class="text-sm">{{ $site->url }}</div>

                        @if ($site->updateAvailable)
                            <div class="text-sm text-yellow-300">Update available!</div>
                        @endif
                        @if ($site->criticalUpdate)
                            <div class="text-sm text-red-500">Critical update available!</div>
                        @endif


                        <div class="flex-1"></div>

                        <div class="bg-cardbgalt h-12 -m-2 mt-4 text-sm flex items-center p-2">
                            <p class="inline">Craft {{ $site->data['craft']['version'] }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection

