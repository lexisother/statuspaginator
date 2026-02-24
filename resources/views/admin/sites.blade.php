@extends('layouts.admin')

@section('a-content')
    @session('error')
        <div class="bg-cardbgcrit border-black border p-4 mb-4">{{ $value }}</div>
    @endsession

    <livewire:site-listing :create="true" :admin="true" />
@endsection
