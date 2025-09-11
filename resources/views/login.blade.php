@extends('layouts.app')

@section('content')
    <div class="flex grow py-8 w-full h-max">
        <div class="mx-auto bg-[#010f1ba3] bg-grid border-x-[4px] border-[#306090]">
            <div class="h-full w-full">
                <div class="flex">
                    <div class="bg-padstripes [transform:scalex(-1)]" style="background-size: 400%;background-repeat: repeat-x;background-position: center;height: 8px;flex-grow: 1;"></div>
                    <div class="bg-padstripes" style="background-size: 400%;background-repeat: repeat-x;background-position: center;height: 8px;flex-grow: 1;"></div>
                </div>

                <div class="h-16 p-1 font-medium" style="">
                    <div class="h-[56px] maskout" style="border-width: 2px 0px 0px; border-color: rgba(156, 223, 255, 0.64);mask-image: linear-gradient(to right,#00000040,transparent,#00000040);"></div>
                    <div class="h-[56px] maskxout" style="margin-top: -56px; background: rgba(88, 170, 237, 0.5); border-width: 0px 4px; border-color: rgb(88, 170, 237);mask-image: linear-gradient(to right,#00000060,#00000020 10%,#00000020 90%,#00000060);"></div>
                    <div class="h-[56px] maskin" style="margin-top: -56px; border-width: 0px 2px 2px; border-color: rgba(88, 170, 237, 0.19);mask-image: radial-gradient(black 64%,transparent 100%);"></div>
                    <div class="h-[56px]" style="margin-top: -75px;">
                        <div class="w-full flex p-1" style="color: #fff; height: 32px;">
                            <div class="grow h-max mr-[-56px]">
                                <div class="s1" style="height: 56px; width: 100%; background: rgba(88, 170, 237, 0.5); opacity: 0.8;clip-path: polygon(1.64px 29.8%,calc(100% - 42.9px) 29.8%,calc(100% - 42.3px) 46.8%,9px 46.8%);"></div>
                                <div class="s2 mt-[-56px]" style="height: 56px; width: 100%; background: rgba(88, 170, 237, 0.5); opacity: 0.6;clip-path: polygon(10.6px 50.8%,calc(100% - 43px) 50.8%,calc(100% - 46.4px) 57.7%,13.6px 57.7%);"></div>
                                <div class="s3 mt-[-56px]" style="height: 56px; width: 100%; background: rgba(88, 170, 237, 0.5); opacity: 0.4;clip-path: polygon(29px 61.7%,calc(100% - 45px) 61.7%,calc(100% - 41.8px) 68.2%,31.8px 68.2%);"></div>
                            </div>
{{--                            <div class="w-max h-max" style="height: 56px; width: 56px; overflow: hidden;">--}}
{{--                                <svg viewBox="0 0 520 280" height="56" width="56">--}}
{{--                                    <path fill="#58aaed80" d="M822.9,226.558l6.457-108.545L720,81.663l-109.352,36.35L617.1,226.558,583.65,260.2l45.307,53.643,26.169-10.691a4.049,4.049,0,0,1,5.412,2.6L672.43,345.83,720,360l47.57-14.17,11.891-40.086a4.049,4.049,0,0,1,5.412-2.6l26.169,10.691L856.35,260.2ZM660.284,272.45A28.846,28.846,0,1,1,689.13,243.6,28.846,28.846,0,0,1,660.284,272.45Zm70.176,34.184L720,295.223l-10.46,11.411a1.012,1.012,0,0,1-1.419.073l-7.048-6.265a2.024,2.024,0,0,1-.339-2.636l15.9-23.846a4.049,4.049,0,0,1,6.737,0l15.9,23.846a2.024,2.024,0,0,1-.339,2.636l-7.048,6.265A1.012,1.012,0,0,1,730.46,306.634Zm49.256-34.184A28.846,28.846,0,1,1,808.562,243.6,28.846,28.846,0,0,1,779.716,272.45Z" transform="translate(-460 -80)"></path>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
                            <div class="grow h-max ml-[-56px]" style="transform: scaleX(-1);">
                                <div class="s1" style="height: 56px; width: 100%; background: rgba(88, 170, 237, 0.5); opacity: 0.8;clip-path: polygon(1.64px 29.8%,calc(100% - 42.9px) 29.8%,calc(100% - 42.3px) 46.8%,9px 46.8%);"></div>
                                <div class="s2 mt-[-56px]" style="height: 56px; width: 100%; background: rgba(88, 170, 237, 0.5); opacity: 0.6;clip-path: polygon(10.6px 50.8%,calc(100% - 43px) 50.8%,calc(100% - 46.4px) 57.7%,13.6px 57.7%);"></div>
                                <div class="s3 mt-[-56px]" style="height: 56px; width: 100%; background: rgba(88, 170, 237, 0.5); opacity: 0.4;clip-path: polygon(29px 61.7%,calc(100% - 45px) 61.7%,calc(100% - 41.8px) 68.2%,31.8px 68.2%);"></div>
                            </div>
                        </div>
                        <div class="mx-auto w-full justify-between text-[13px] leading-[14px] font-ttsquares font-bold tracking-widest mt-[22px] flex text-[#58aaedcc]" style="opacity: 0.64;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" class="h-4 w-4 ml-[8px]">
                                <path fill="#58aaed90" d="M0,56v64H64V56Zm32,55A23,23,0,1,1,55,88,23,23,0,0,1,32,111Z M16 88a16 16 0 1 0 32 0a16 16 0 1 0 -32 0 M88 88h32v32H88Z"></path>
                            </svg>
                            <div class="noselect">CRAFT COMPANION SYSTEM</div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" class="h-4 w-4 mr-[8px] flipx">
                                <path fill="#58aaed90" d="M0,56v64H64V56Zm32,55A23,23,0,1,1,55,88,23,23,0,0,1,32,111Z M16 88a16 16 0 1 0 32 0a16 16 0 1 0 -32 0 M88 88h32v32H88Z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-2 text-[#58aaed] font-medium">
                    <div class="w-[320px] md:w-[640px] flex flex-col items-center gap-2 my-2 px-4 text-[14px] leading-[16px]">
                        <div class="text-[#9cffdf] text-xl leading-[14px]">
                            Please login.
                        </div>
{{--                        <div class="text-[#9cffdf] text-[15px] leading-[14px]">--}}
{{--                            <span class="flex-none w-full box-border whitespace-pre-wrap">Congratulations Helldiver, your COMPANION HELLPAD SYSTEM (CHS) has been updated.</span>--}}
{{--                        </div>--}}
{{--                        <div class="text-[12px] leading-[14px] mb-1">--}}
{{--                            <span class="flex-none w-full box-border whitespace-pre-wrap">Over time, CHS will be updated with a comprehensive database of interactive modules, historical archives, and mission-relevant data; all designed to support Super Earth's elite (that's you) in galactic liberation, and serve as a vital resource for mission planning and field intelligence.</span>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    <x-layout.pagecard class="w-1/2 self-center bg-cardbgalt">--}}
    {{--        <form class="flex flex-col gap-1" enctype="multipart/form-data" action="/login" method="POST">--}}
    {{--            @csrf--}}
    {{--            <h1 class="text-center text-2xl mb-4">Login</h1>--}}

    {{--            @if ($errors->any())--}}
    {{--                <div class="p-4 bg-cardbgcrit border border-black shadow-md mb-4">--}}
    {{--                    {{ $errors->first() }}--}}
    {{--                </div>--}}
    {{--            @endif--}}

    {{--            <div class="flex flex-col gap-4">--}}
    {{--                <div class="flex flex-col">--}}
    {{--                    <label>Email</label>--}}
    {{--                    <input--}}
    {{--                        type="email"--}}
    {{--                        name="email"--}}
    {{--                        class="h-14 p-4 flex-1 md:flex-none bg-cardbg border border-black shadow-md"--}}
    {{--                        required />--}}
    {{--                </div>--}}
    {{--                <div class="flex flex-col">--}}
    {{--                    <label>Password</label>--}}
    {{--                    <input--}}
    {{--                        type="password"--}}
    {{--                        name="password"--}}
    {{--                        class="h-14 p-4 flex-1 md:flex-none bg-cardbg border border-black shadow-md"--}}
    {{--                        required />--}}
    {{--                </div>--}}

    {{--                <input type="submit" value="Login" class="flex items-center justify-center space-x-2 bg-blurple py-1 px-6 hover:cursor-pointer" />--}}
    {{--            </div>--}}
    {{--        </form>--}}
    {{--    </x-layout.pagecard>--}}
@endsection
