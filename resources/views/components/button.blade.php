@props(['to', 'label', 'newtab'])

<a
    class="bg-blurple py-1 px-6 hover:cursor-pointer"
    href="{{ $to }}"
    @if($newtab ?? false) target="_blank" @endif
>{!! $slot !!}</a>
