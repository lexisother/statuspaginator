@extends('layouts.admin')

@section('a-content')
    @if (isset($exists))
        <p>This site already exists.</p>
    @elseif(isset($token))
        <form enctype="multipart/form-data" action="/admin/sites/register" method="POST">
            @csrf
            <input type="text" name="token" value="{{ $token }}" hidden>

            <p>NOTE: Copy this token into the settings of the site's Statuspaginator plugin, <i>then</i> click register!</p>
            <textarea class="w-full p-2 border border-black bg-cardbg">{{ $token }}</textarea>
            <input type="submit" value="Register" class="flex items-center justify-center space-x-2 bg-blurple py-1 px-6 hover:cursor-pointer mb-4" />
        </form>
    @else
        <form class="flex flex-col gap-4 w-[30rem]" enctype="multipart/form-data" action="/admin/sites/create" method="POST">
            @csrf
            <div class="flex flex-col gap-2">
                <label for="url">Url</label>
                <input
                    type="text"
                    name="url"
                    class="h-14 p-4 flex-1 md:flex-none bg-cardbg border border-black shadow-md" />
            </div>

            <input type="submit" value="Create" class="flex items-center justify-center space-x-2 bg-blurple py-1 px-6 hover:cursor-pointer mb-4" />
        </form>
    @endif
@endsection
