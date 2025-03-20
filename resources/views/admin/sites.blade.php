@extends('layouts.admin')

@section('a-content')
    <livewire:site-listing :create="true" :admin="true" />
@endsection
