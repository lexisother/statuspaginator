{{-- :harold: --}}
@php
    use Illuminate\Support\Facades\Route;
    function activeOrNot($name)
    {
        return Route::is($name) ? 'bg-cardbg border-l-accent' : 'border-l-transparent';
    }
@endphp

<div class="bg-cardbgalt border border-black flex flex-col p-4 gap-2">
    <div class="flex flex-col">
        <h1 class="text-xl">Administration</h1>
        <a href="/admin/dashboard/users" class="border-l-2 px-1 {{ activeOrNot('admin.users') }}">
            <span>Users</span>
        </a>
        <a href="/admin/dashboard/roles" class="border-l-2 px-1 {{ activeOrNot('admin.roles') }}">
            <span>Roles</span>
        </a>
    </div>

    <div class="flex flex-col">
        <h3 class="text-lg">Site management</h3>
        <a href="/admin/dashboard/sites" class="border-l-2 px-1 {{ activeOrNot('admin.sites') }}">
            <span>Sites</span>
        </a>
    </div>
</div>
