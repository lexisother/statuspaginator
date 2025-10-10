@props(['to'])

<a
    href="{{ route($to) }}"
    class="border-l-2 px-1 {{ Route::is($to) ? 'bg-cardbg border-l-accent' : 'border-l-transparent' }}"
>
    <span>{{ $slot }}</span>
</a>
