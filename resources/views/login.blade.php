@extends('layouts.app')

@section('content')
    <x-layout.pagecard class="w-1/2 self-center bg-cardbgalt">
        <form class="flex flex-col gap-1" enctype="multipart/form-data" action="/login" method="POST">
            @csrf
            <h1 class="text-center text-2xl mb-4">Login</h1>

            @if ($errors->any())
                <div class="p-4 bg-cardbgcrit border border-black shadow-md mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="flex flex-col gap-4">
                <div class="flex flex-col">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        class="h-14 p-4 flex-1 md:flex-none bg-cardbg border border-black shadow-md"
                        required />
                </div>
                <div class="flex flex-col">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        class="h-14 p-4 flex-1 md:flex-none bg-cardbg border border-black shadow-md"
                        required />
                </div>

                <input type="submit" value="Login" class="flex items-center justify-center space-x-2 bg-blurple py-1 px-6 hover:cursor-pointer" />
            </div>
        </form>
    </x-layout.pagecard>
@endsection
