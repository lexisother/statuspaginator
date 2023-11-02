@extends('layouts.app')

@section('content')
    <x-layout.pagecard>
        <a class="m-8" href="/sites/{{ $siteId }}">&lt; back to site</a>
        <div class="m-10 mt-0">
            @foreach ($plugins as $plugin)
                <x-plugin :plugin="$plugin" />
            @endforeach
        </div>
    </x-layout.pagecard>
@endsection
