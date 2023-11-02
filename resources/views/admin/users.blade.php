@extends('layouts.admin')

@section('a-content')
    <div class="flex flex-col gap-4">
        @foreach($roles as $role => $users)
            <div>
                <h1 class="text-2xl pb-2">{{ Str::title($role) }}</h1>
                <div class="grid grid-cols-1 gap-4 mx-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                    @foreach($users as $user)
                        <x-admin.user :user="$user" />
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
