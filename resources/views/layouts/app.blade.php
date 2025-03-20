<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" @yield('htmlExt')>

<head>
    <title>
        @hasSection('title')
            @yield('title') • {{ Config::get('app.name') }}
        @else
            {{ Config::get('app.name') }}
        @endif
    </title>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow, noarchive" />
    <meta name="referrer" content="never" />
    <meta name="referrer" content="no-referrer" />

    @yield('head')

    @stack('css')
    @livewireStyles

    @stack('head-js')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="text-card font-mono flex flex-col min-h-screen {{ app()->isLocal() ? 'debug-screens' : '' }}">
        <div class="bg-gradient-to-b from-gradt to-gradb fixed left-0 top-0 h-[120vh] md:h-[100vh] w-[100vw] -z-10"></div>
        <x-layout.header />

        @if (Config::get('app.debug') == 1)
            <div class="debug-container">
                <code>@yield('debugcontent')</code>
            </div>
        @endif

        @yield('content')

        <div class="flex-1"></div>

        <div class="text-right text-subtitle italic m-4">
            <p class="inline">Made with &lt;3 by <a class="underline" href="https://brik.digital">Brik.digital</a></p>
        </div>
    </div>

    @stack('body-js')
    @livewireScripts
</body>
