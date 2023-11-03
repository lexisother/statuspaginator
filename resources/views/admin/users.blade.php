@extends('layouts.admin')

@section('a-content')
    <div x-data="{ modelOpen: false }">
        <button @click="modelOpen = !modelOpen" class="flex items-center justify-center space-x-2 bg-blurple py-1 px-6 hover:cursor-pointer mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>

            <span>Create user</span>
        </button>

        <div class="flex flex-col gap-4">
            @foreach($roles as $role => $users)
                <div>
                    <h1 class="text-2xl pb-2">{{ Str::title($role) }}</h1>
                    @if($users->isEmpty())
                        <p class="italic">No users in this role...</p>
                    @else
                        <div class="grid grid-cols-1 gap-4 mx-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                            @foreach($users as $user)
                                <x-admin.user :user="$user" />
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- TODO: REDESIGN!!! --}}
        <div x-cloak x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                ></div>

                <div x-cloak x-show="modelOpen"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                >
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Create user</h1>

                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <form class="mt-5" enctype="multipart/form-data" action="/admin/users/create" method="POST">
                        @csrf

                        <div class="flex flex-col gap-4">
                            <div>
                                <label for="name" class="block text-sm text-gray-700 capitalize">Name</label>
                                <input id="name" name="name" placeholder="Brik Brik" type="text" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                            </div>
                            <div>
                                <label for="email" class="block text-sm text-gray-700 capitalize">Email</label>
                                <input id="email" name="email" placeholder="dev@brik.digital" type="email" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                            </div>
                            <div>
                                <label for="password" class="block text-sm text-gray-700 capitalize">Password</label>
                                <input id="password" name="password" placeholder="brikbrik" type="password" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                            </div>
                            <div>
                                <label for="role" class="block text-sm text-gray-700 capitalize">Role</label>
                                <select id="role" name="role" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    @foreach ($roles as $role => $_)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <input type="submit" value="Create user" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
