@props(['create', 'admin'])

<div>
    <div class="flex justify-center">
        <input
            wire:model.live="search"
            class="h-16 mb-10 mx-4 p-4 w-[30rem] flex-1 md:flex-none bg-cardbg border border-black shadow-md"
            placeholder="Search sites..."
        />

        <div class="flex flex-row gap-2">
            @if ($create)
                <a href="/admin/sites/create" class="flex items-center bg-blurple px-6 hover:cursor-pointer mb-10">+</a>
            @endif

            <div class="relative inline-block text-left" x-data="{ open: false }">
                <div>
                    <button @click="open = !open" class="h-16 p-4 bg-cardbg border border-black shadow-md">
                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                        </svg>
                    </button>
                </div>

                <div x-cloak x-show="open" @click.outside="open = false" class="absolute right-0 z-50 mt-2 origin-top-right min-w-max border border-black bg-cardbg focus:outline-hidden">
                    <div class="px-4 py-2">
                        <div class="flex flex-row items-center gap-2">
                            <p>Craft version:</p>
                            <select class="h-16 p-4 bg-cardbg border border-black shadow-md" wire:model.live="constraint">
                                <option value="" selected>No constraint</option>
                                @foreach([3, 4, 5] as $version)
                                    <option value="^{{ $version }}.0.0">Craft {{ $version }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="px-4 py-2">
                        <div class="flex flex-row items-center gap-2">
                            <p>Plugins:</p>
                            <div x-data="{ search: '' }" class="w-60 bg-cardbgalt border border-black">
                                <div class="p-3">
                                    <input x-model="search" type="text" class="border text-sm w-full p-2.5 border-black bg-gray-600 text-white" placeholder="Search...">
                                </div>
                                <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200">
                                    @foreach(['blitz', 'seomatic', 'sprig'] as $plugin)
                                        <li x-show="search === '' || '{{ $plugin }}'.includes(search)">
                                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input wire:model.live="plugins" id="checkbox-item-11" type="checkbox" value="{{ $plugin }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="checkbox-item-11" class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">{{ $plugin }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2">
                        <div class="flex flex-row items-center gap-2">
                            <p>Is critical:</p>
                            <input type="checkbox" wire:model.live="isCritical" class="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 mx-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 {{ !$create ? '3xl:grid-cols-5' : '' }}">
        @foreach($sites as $site)
            <x-site-card :site="$site" />
        @endforeach
    </div>
</div>
