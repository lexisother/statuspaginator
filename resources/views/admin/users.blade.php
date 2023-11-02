@extends('layouts.admin')

@section('a-content')
    <div x-data="{ showForm: false }" class="select-none">
        <a @click="showForm = !showForm" class="bg-blurple py-1 px-6 hover:cursor-pointer">+</a>
        <form x-show="showForm" enctype="multipart/form-data" action="/admin/users/create" method="POST">
            @csrf

            <label for="name" class="form-label">Name</label>
            <input id="name" class="text-field" type="text" name="name" />

            <label for="email" class="form-label">Email</label>
            <input id="email" class="text-field" type="text" name="email" />

            <label for="password" class="form-label">Password</label>
            <input id="password" class="text-field" type="password" name="password" />

            <label for="role" class="form-label">Role</label>
            <select id="role" name="role">
                @foreach ($roles as $role => $_)
                    <option value="{{ $role }}">{{ Str::title($role) }}</option>
                @endforeach
            </select>


            <input type="submit" hidden />
        </form>
    </div>
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
