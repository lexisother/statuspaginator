@props(['to', 'label'])

<a
    class="bg-blurple py-1 px-6 hover:cursor-pointer"
    href="{{ $to }}"
    target="_blank"
>{!! $slot !!}</a>
