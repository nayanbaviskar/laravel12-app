<nav class="sticky top-0 z-50 border-b border-zinc-200/80 bg-white/80 backdrop-blur-md">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div>
            <a href="/" class="flex items-center gap-2 text-lg font-bold tracking-tight text-zinc-900 hover:text-zinc-700 transition-colors">
                <svg class="h-6 w-6 text-zinc-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/>
                    <path d="M9 18h6"/>
                    <path d="M10 22h4"/>
                </svg>
                <span>Idea</span>
            </a>
        </div>
        <div class="flex items-center gap-x-3 sm:gap-x-4">
            @guest
                <a href="/login" class="text-sm font-medium text-zinc-600 hover:text-zinc-900 transition-colors">
                    Sign In
                </a>
                <a href="/register" class="btn btn-primary">
                    Register
                </a>
            @endguest
            @auth
                <form action="/logout" method="post" class="inline-block">
                    @csrf
                    <button type="submit" class="btn btn-outline">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
