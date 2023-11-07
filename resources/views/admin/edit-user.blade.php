@extends('layouts.admin')

@section('a-content')
    <form class="flex flex-col gap-4 w-[30rem]" enctype="multipart/form-data" action="/admin/users/edit/{{ $user->id }}" method="POST">
        @csrf @method('PATCH')
        <div class="flex flex-col gap-2">
            <label for="name">Name</label>
            <input
                type="text"
                name="name"
                value="{{ $user->name }}"
                class="h-14 p-4 flex-1 md:flex-none bg-cardbg border border-black shadow-md" />
        </div>
        <div class="flex flex-col gap-2">
            <label for="email">E-Mail</label>
            <input
                type="email"
                name="email"
                value="{{ $user->email }}"
                class="h-14 p-4 flex-1 md:flex-none bg-cardbg border border-black shadow-md" />
        </div>
        <div class="flex flex-col gap-2">
            <label for="password">Password</label>
            <input
                type="password"
                name="password"
                class="h-14 p-4 flex-1 md:flex-none bg-cardbg border border-black shadow-md" />
        </div>

        <input type="submit" value="Save" class="flex items-center justify-center space-x-2 bg-blurple py-1 px-6 hover:cursor-pointer mb-4" />
    </form>
    <form class="flex flex-col w-[30rem]" enctype="multipart/form-data" action="/admin/users/delete/{{ $user->id }}" method="POST">
        @csrf
        <input type="submit" value="Delete" class="flex items-center justify-center space-x-2 bg-red-800 py-1 px-6 hover:cursor-pointer mb-4" />
    </form>
@endsection
