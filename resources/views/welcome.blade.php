<x-layout>
    <div class="py-16 sm:py-24">
        @if (session('success'))
            <div class="mx-auto mb-8 max-w-xl rounded-xl border border-emerald-200 bg-emerald-50/80 p-4 text-sm text-emerald-800 shadow-xs backdrop-blur-xs flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="mx-auto max-w-3xl text-center">
            <span class="inline-flex items-center gap-2 rounded-full border border-zinc-200/80 bg-white px-3 py-1 text-xs font-medium text-zinc-600 shadow-2xs">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                Welcome to Idea
            </span>

            <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-zinc-900 sm:text-5xl lg:text-6xl">
                Capture, build, and organize your next big thing.
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-base text-zinc-600 sm:text-lg">
                A simple and focused place to turn raw thoughts into actionable steps. Start sharing and collaborating seamlessly today.
            </p>

            <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                @guest
                    <a href="/register" class="btn btn-primary px-5 py-3 font-semibold">
                        Get Started
                    </a>
                    <a href="/login" class="btn btn-outline px-5 py-3 font-semibold">
                        Sign In
                    </a>
                @endguest

                @auth
                    <div class="card p-6">
                        <p class="text-sm text-zinc-500">Signed in as</p>
                        <p class="mt-1 text-lg font-semibold text-zinc-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-zinc-400">{{ auth()->user()->email }}</p>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-layout>
