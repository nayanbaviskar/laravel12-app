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
                    @if($idea->image_path)
                        <div class="mb-4 -mx-4 -mt-4 rounded-t-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $idea->image_path) }}" alt="" class="w-full h-48 object-cover">
                        </div>
                    @endif
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
            <form x-data="{'status':'pending', 'newLink':'', links:[], 'newStep':'', steps:[], hasImage: false}"
                method="post" action="{{ route('idea.store') }}" :enctype="hasImage ? 'multipart/form-data' : null">
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

                    <div class="space-y-1.5">
                        <label for="image" class="label">Featured Image</label>
                        <input type="file" name="image" id="image" accept="image/*" class="form-file" @change="hasImage = $el.files.length > 0" />
                        <x-form.error name='image' />
                    </div>

                    <!-- Steps -->
                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Steps</legend>
                            <template x-for="(step, index) in steps">
                                <div class="flex gap-x-2 items-center">
                                    <input name="steps[]" x-model="steps[index]" class="form-input flex-1" />
                                    <button type="button" class="btn-danger shrink-0" @click="steps.splice(index,1);"
                                        aria-label="Remove Step">
                                        <x-icons.trash class="w-4 h-4" />
                                    </button>
                                </div>
                            </template>
                            <div class="flex gap-x-2 items-center">
                                <input data-test="new-step" id="new-step" x-model="newStep"
                                    placeholder="What needs to be done?" class="form-input flex-1" spellcheck="false" />
                                <button type="button" data-test="add-new-step"
                                    class="btn-icon shrink-0 disabled:opacity-40 disabled:cursor-not-allowed"
                                    @click="steps.push(newStep.trim());newStep='';"
                                    :disabled="newStep.trim().length===0" aria-label="Add new step">
                                    <x-icons.plus class="w-4 h-4" />
                                </button>
                            </div>
                        </fieldset>
                    </div>
                    <!--end steps -->
                    <!-- links start -->
                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Links</legend>
                            <template x-for="(link, index) in links">
                                <div class="flex gap-x-2 items-center">
                                    <input name="links[]" x-model="links[index]" class="form-input flex-1" />
                                    <button type="button" class="btn-danger shrink-0" @click="links.splice(index,1);"
                                        aria-label="Remove link">
                                        <x-icons.trash class="w-4 h-4" />
                                    </button>
                                </div>
                            </template>
                            <div class="flex gap-x-2 items-center">
                                <input type="url" data-test="new-link" id="new-link" x-model="newLink"
                                    placeholder="http://example.com" autocomplete="url" class="form-input flex-1"
                                    spellcheck="false" />
                                <button type="button" data-test="add-new-link"
                                    class="btn-icon shrink-0 disabled:opacity-40 disabled:cursor-not-allowed"
                                    @click="links.push(newLink.trim());newLink='';"
                                    :disabled="newLink.trim().length===0" aria-label="Add new link">
                                    <x-icons.plus class="w-4 h-4" />
                                </button>
                            </div>
                        </fieldset>
                    </div>
                    <!---links ends-->
                    <div class="flex justify-end gap-x-5">
                        <button type="button" class="btn" @click="$dispatch('close-modal')">Cancel</button>
                        <button class="btn btn-primary p-3" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </x-modal>
    </div>
</x-layout>