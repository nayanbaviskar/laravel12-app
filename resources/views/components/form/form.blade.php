@props(['title', 'description' => null])

<div class="flex min-h-[calc(100dvh-5rem)] items-center justify-center px-4 py-12">
    <div class="w-full max-w-md rounded-2xl border border-zinc-200/80 bg-white p-6 shadow-sm sm:p-8">
        <div class="text-center">
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900 sm:text-3xl">{{ $title }}</h1>
            @if ($description)
                <p class="mt-2 text-sm text-zinc-500">{{ $description }}</p>
            @endif
        </div>
        {{ $slot }}
    </div>
</div>
