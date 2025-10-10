<div class="bg-cardbgalt border border-black flex flex-col p-4 gap-2">

    <div class="flex flex-col">
        <h1 class="text-xl">Administration</h1>
        <x-admin.sidebar-link to="admin.users">Users</x-admin.sidebar-link>
        <x-admin.sidebar-link to="admin.roles">Roles</x-admin.sidebar-link>
    </div>

    <div class="flex flex-col">
        <h3 class="text-lg">Site management</h3>
        <x-admin.sidebar-link to="admin.sites">Sites</x-admin.sidebar-link>
        <x-admin.sidebar-link to="admin.sites.updates">Craft Updates</x-admin.sidebar-link>
    </div>
</div>
