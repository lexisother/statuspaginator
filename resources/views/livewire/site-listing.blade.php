@props(['create', 'admin'])

<div>
    <div class="flex justify-center">
        <input
            wire:model.live="search"
            class="h-16 mb-10 mx-4 p-4 w-[30rem] flex-1 md:flex-none bg-cardbg border border-black shadow-md"
            placeholder="Search sites..."
        />
        @if ($create)
            <a href="/admin/sites/create" class="flex items-center bg-blurple px-6 hover:cursor-pointer mb-10">+</a>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-4 mx-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 {{ !$create ? '3xl:grid-cols-5' : '' }}">
        @foreach($sites as $site)
            <x-site-card :site="$site" />
        @endforeach
    </div>
</div>
