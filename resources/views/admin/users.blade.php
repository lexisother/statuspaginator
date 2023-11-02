@extends('layouts.admin')

@section('a-content')
    <div>
        @foreach($users as $user)
            {{ $user->name }}
        @endforeach
    </div>
@endsection
