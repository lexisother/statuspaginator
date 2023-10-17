@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 gap-4 mx-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
        @foreach($sites as $site)
            <div class="bg-cardbg border-black border shadow-md p-2 min-h-[9.5rem] grid">
                <div class="flex flex-col row-start-1 col-start-1">
                    <div class="text-lg">{{ $site->name }}</div>
                    <div class="text-sm">{{ $site->url }}</div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

