<x-layout>
    <div class="py-8 md:py-12">
        <header class="mb-8">
            <h1 class="title">Ideas</h1>
            <p class="subtitle mt-2">Capture your thoughts. make a plan</p>

            <x-card x-data @click="$dispatch('open-modal','create-idea')" is="button" data-test="create-idea-button"
                class="mt-10 cursor-pointer h-32 w-full text-left">
                <p>What's the Idea.</p>
            </x-card>
        </header>
        <div class="mb-6 flex flex-wrap gap-2">
            <a href="/ideas" class="btn {{ !request()->has('status') ? 'btn-primary' : 'btn-outline' }}">
                All
            </a>
            @foreach(App\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{ $status->value }}"
                    class="btn {{ request('status') === $status->value ? 'btn-primary' : 'btn-outline' }}">
                    {{ $status->label() }}
                    <span class="count-pill">{{ $statusCount->get($status->value) }}</span>
                </a>
            @endforeach
        </div>
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

        <!--- modal -->
        <x-modal name="create-idea" title="New Idea">
            <form x-data="{'status':'pending'}" method="post" action="{{ route('idea.store') }}">
                @csrf
                <div class="space-y-6">
                    <x-form.field name="title" label="Title" placeholder="Enter idea for the title" autofocus
                        required />
                    <div class="space-y-2">
                        <label for="status" class="label">Status</label>
                        <div class="gap-x-3">
                            @foreach (App\IdeaStatus::cases() as $status)
                                <button type="button" @click="status=@js($status->value)" class="btn flex-1 h-10"
                                    :class="{'btn-outlined': status !== @js($status->value)}"
                                    data-test="button-status-{{ $status->value }}">
                                    {{ $status->label() }}
                                </button>
                            @endforeach
                            <input type="hidden" name="status" :value="status" />
                        </div>
                        <x-form.error name='status' />
                    </div>
                    <x-form.field name="description" label="Description" placeholder="Describe your idea.."
                        type="textarea" />
                    <div class="flex justify-end gap-x-5">
                        <button type="button" class="btn" @click="$dispatch('close-modal')">Cancel</button>
                        <button class="btn btn-primary p-3" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </x-modal>
    </div>
</x-layout>