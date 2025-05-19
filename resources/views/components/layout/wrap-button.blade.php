@props([
    'topText' => '',
    'mainText' => '',
    'href' => '',
    'icon' => ''
])

@if ($href)
    <a href="{{ $href }}">
@endif
<button class="relative flex items-center justify-between bg-transparent min-w-10 h-10 button-wrapper">
    <div class="px-3 box-border w-full bg-[#74747460] [clip-path:inset(5px)]">
        <div class="max-w-10 h-10 sm:w-fit"></div>
    </div>
    <div class="mx-auto -ml-[100%] box-border w-full">
        <div class="flex justify-center content">
            @if ($icon)
                <div class="w-max h-max block mt-[1px] min-[640px]:mt-[6px]">
                    <x-icon name="ri:login-circle-fill" width="24px" height="24px" />
                </div>
            @endif

            <div @class(['hidden mt-[6.4px] min-[640px]:inline font-bold', 'ml-1.5' => $icon])>
                <div class="mb-[-12px] text-[11px] mt-[-6px]">{{ $topText }}</div>
                <div class="text-[16px]">{{ $mainText }}</div>
            </div>
        </div>
    </div>
</button>
@if($href)
    </a>
@endif
