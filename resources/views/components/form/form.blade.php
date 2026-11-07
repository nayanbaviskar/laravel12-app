@props(['title', 'description' => null])

<div class="flex min-h-[calc(100dvh-5rem)] items-center justify-center px-4 py-12">
    <div class="card w-full max-w-md sm:p-8">
        <div class="text-center">
            <h1 class="title sm:text-3xl">{{ $title }}</h1>
            @if ($description)
                <p class="subtitle mt-2">{{ $description }}</p>
            @endif
        </div>
        {{ $slot }}
    </div>
</div>
