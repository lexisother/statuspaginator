@extends('layouts.app')

@section('content')
    <x-layout.pagecard class="flex flex-col gap-4 lg:flex-row">
        <x-admin.sidebar />
        <div class="w-full p-4 bg-cardbgalt border border-black">
            @yield('a-content')
        </div>
    </x-layout.pagecard>
@endsection
