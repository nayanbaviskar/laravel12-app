<x-layout>
    <div class="container-page">
        <div class="flex items-center justify-between">
            <a href="{{ route('idea.index') }}" class="back-link">
                <x-icons.arrow-left class="w-4 h-4" />
                <span>Back</span>
            </a>
            <div class="flex items-center gap-x-2">
                <button class="btn-icon" title="Edit Idea">
                    <x-icons.pencil class="w-4 h-4" />
                </button>
                <form method="post" action="{{ route('idea.destroy', $idea) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn-danger" title="Delete Idea">
                        <x-icons.trash class="w-4 h-4" />
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-8 space-y-6">
            <div>
                <h1 class="title">{{ $idea->title }}</h1>
                <div class="mt-3 flex items-center gap-3">
                    <x-status-label status="{{ $idea->status }}">
                        {{ $idea->status->label() }}
                    </x-status-label>
                    <span class="meta-date">
                        <x-icons.clock class="mr-1 h-3.5 w-3.5" />
                        {{ $idea->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>

            <div class="card-content">
                {{ $idea->description }}
            </div>
            <!-- steps goes from here -->
            @if($idea->steps->count())
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Actionable Steps</h3>
                    <div class="mt-3 space-y-2">
                        @foreach ($idea->steps as $step)
                            <x-card class="text-primary font-medium flex gap-x-3 items-center">
                                <div class="flex items-center gap-x-3">
                                    <form method="post" action="{{ route('step.update', $step) }}" class="flex gap-x-3">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" role="checkbox"
                                            class="checkbox {{ $step->completed ? 'checkbox-checked' : '' }}">
                                            @if ($step->completed)
                                                <x-icons.check class="size-3.5 stroke-[2.5]" />
                                            @endif
                                        </button>
                                        <span class="{{ $step->completed ? 'line-through' : '' }}">{{ $step->description }}</span>
                                    </form>
                                </div>
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- links starts here-->
            @if($idea->links->count())
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Links</h3>
                    <div class="mt-3 space-y-2">
                        @foreach ($idea->links as $link)
                            <a href="{{ $link }}" target="_blank" rel="noopener noreferrer" class="link-card">
                                <div class="flex items-center gap-2.5 truncate">
                                    <x-icons.link class="h-4 w-4 shrink-0 text-gray-400" />
                                    <span class="truncate">{{ $link }}</span>
                                </div>
                                <x-icons.external-link class="h-4 w-4 shrink-0 text-gray-400" />
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>