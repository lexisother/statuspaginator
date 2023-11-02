@props(['user'])

<div
    class="bg-cardbg border-black border shadow-md p-2 min-h-8 grid"
    x-data="{ overlayShow: false }"
>
    {{-- overlay on hover --}}
    <a
        href="/admin/users/{{ $user->id }}"
        class="flex items-center justify-center row-start-1 col-start-1 z-10 -m-2 cursor-pointer transition-opacity bg-gradient-to-t from-gradt to-gradb"
        @mouseover="overlayShow = true" @mouseleave="overlayShow = false"
        x-cloak
        :style="{ opacity: overlayShow ? 1 : 0 }"
    >
        Show details
    </a>

    <div class="flex flex-col row-start-1 col-start-1">
        <div class="flex flex-row justify-between flex-grow" @mouseover="overlayShow = true" @mouseleave="overlayShow = false">
            <div>
                <div class="text-sm">{{ $user->name }}</div>
                <div class="text-sm">{{ $user->email }}</div>
            </div>
        </div>
    </div>
</div>
