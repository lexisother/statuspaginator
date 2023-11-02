<div class="grid grid-cols-1 md:grid-cols-3 justify-items-center bg-navbg text-navfg px-24 py-4 shadow-md mb-4">
    <div></div>
    <div class="flex items-center">
        <img class="inline h-6 mr-2 rounded" src="https://avatars.githubusercontent.com/u/22369139?s=200&v=4" />
        <a href="/" class="inline">Statuspaginator</a>
    </div>
    <div>
        @guest
            <a href="/admin" class="inline">Login</a>
        @else
            <a href="/admin" class="flex items-center gap-2">
                <p class="inline">{{ Auth::user()->name }}</p>
                @role('admin')
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' style="width: 18px; height: 18px">
                        <path fill='currentColor' d='M14.5,12.59l0.63,2.73c0.1,0.43-0.37,0.77-0.75,0.54L12,14.42l-2.39,1.44c-0.38,0.23-0.85-0.11-0.75-0.54L9.5,12.6 l-2.1-1.81C7.06,10.5,7.24,9.95,7.68,9.91l2.78-0.24l1.08-2.56c0.17-0.41,0.75-0.41,0.92,0l1.08,2.55l2.78,0.24 c0.44,0.04,0.62,0.59,0.28,0.88L14.5,12.59z M4.19,4.47C3.47,4.79,3,5.51,3,6.3V11c0,5.55,3.84,10.74,9,12c5.16-1.26,9-6.45,9-12 V6.3c0-0.79-0.47-1.51-1.19-1.83l-7-3.11c-0.52-0.23-1.11-0.23-1.62,0L4.19,4.47z'/>
                    </svg>
                @endrole
            </a>
        @endif
    </div>
</div>
