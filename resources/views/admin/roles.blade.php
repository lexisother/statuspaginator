@extends('layouts.admin')

@section('a-content')
    <div class="flex flex-col gap-4">
        <form x-show="showForm" enctype="multipart/form-data" action="/admin/roles/create" method="POST">
            @csrf

            <label for="name" class="form-label">Name</label>
            <input id="name" class="text-field" type="text" name="name" />

            <input class="bg-blurple py-1 px-6 hover:cursor-pointer" type="submit" value="+" />
        </form>

        <div>
            @foreach($roles as $role => $amount)
                <p>{{ $role }}: {{ $amount }}</p>
            @endforeach
        </div>
    </div>
@endsection
