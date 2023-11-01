<div class="grid grid-cols-1 md:grid-cols-3 justify-items-center bg-navbg text-navfg px-24 py-4 shadow-md mb-4">
    <div></div>
    <div class="flex items-center">
        <img class="inline h-6 mr-2 rounded" src="https://avatars.githubusercontent.com/u/22369139?s=200&v=4" />
        <a href="/" class="inline">Statuspaginator</a>
    </div>
    <div class="flex items-center gap-4">
        @guest
            <a href="/login" class="inline">Login</a>
        @else
            <p class="inline"></p>
        @endif
    </div>
</div>
