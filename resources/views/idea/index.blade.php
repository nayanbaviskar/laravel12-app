<x-layout>
    <div class="py-8 md:py-12">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Ideas</h1>
            <p class="text-gray-500 text-sm mt-2">Capture your thoughts. make a plan</p>
        </header>

        <div class="grid gap-6 md:grid-cols-2">
            @forelse($ideas as $idea)
                <x-card href="{{ route('idea.show', $idea) }}">
                    <div class="flex items-start justify-between gap-3">
                        <x-status-label status="{{ $idea->status }}">
                            {{ $idea->status->label() }}
                        </x-status-label>
                        <span class="text-xs text-gray-400">
                            {{ $idea->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <h2 class="mt-3 text-lg font-semibold text-gray-900">
                        {{ $idea->title }}
                    </h2>

                    <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                        {{ $idea->description }}
                    </p>
                </x-card>
            @empty
                <div class="col-span-full border border-gray-200 rounded-lg bg-white p-8 text-center text-gray-500">
                    <p>No ideas yet</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>

