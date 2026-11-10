@props(['idea' => new App\Models\Idea()])

<x-modal name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}" title="{{ $idea->exists ? 'Edit Idea' : 'New Idea'}}">
    <form x-data="{
                'status': @js(old('status', $idea->status->value)), 
                'newLink':'', 
                links:@js(old('links', $idea->links ?? [])), 
                'newStep':'', 
                steps:@js(old('steps', $idea->steps->map->only(['id', 'description', 'completed']))), 
                hasImage: false
            }" method="post" action="{{ $idea->exists ? route('idea.update', $idea) : route('idea.store') }}"
        :enctype="hasImage ? 'multipart/form-data' : null">
        @csrf
        @if ($idea->exists)
            @method('PATCH')
        @endif
        <div class="space-y-6">
            <x-form.field name="title" label="Title" placeholder="Enter idea for the title" autofocus required
                :value="$idea->title" />
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
            <x-form.field name="description" label="Description" placeholder="Describe your idea.." type="textarea"
                :value="$idea->description" />

            <div class="space-y-1.5">
                <label for="image" class="label">Featured Image</label>

                @if ($idea->image_path)
                    <div class="rounded-lg overflow-hidden space-y-2">
                        <img src="{{ asset('storage/' . $idea->image_path) }}" alt="" class="w-full h-auto object-cover">
                    </div>
                    <button type="submit" class="btn btn-outlined h-10 w-full" form="delete-image-form">
                        Remove Image
                    </button>
                @endif

                <input type="file" name="image" id="image" accept="image/*" class="form-file"
                    @change="hasImage = $el.files.length > 0" />
                <x-form.error name='image' />
            </div>

            <!-- Steps -->
            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Actionable Steps</legend>
                    <template x-for="(step, index) in steps" :key="step.id ?? index">
                        <div class="flex gap-x-2 items-center">
                            <input :name="`steps[${index}][description]`" x-model="step.description"
                                class="form-input flex-1" />
                            <input type="hidden" :name="`steps[${index}][completed]`" :value="step.completed ? '1':'0'"
                                class="form-input flex-1" />
                            <button type="button" class="btn-danger shrink-0" @click="steps.splice(index,1);"
                                aria-label="Remove Step">
                                <x-icons.trash class="w-4 h-4" />
                            </button>
                        </div>
                    </template>
                    <div class="flex gap-x-2 items-center">
                        <input data-test="new-step" id="new-step" x-model="newStep" placeholder="What needs to be done?"
                            class="form-input flex-1" spellcheck="false" />
                        <button type="button" data-test="add-new-step"
                            class="btn-icon shrink-0 disabled:opacity-40 disabled:cursor-not-allowed"
                            @click="steps.push({description : newStep.trim(), completed : false});newStep='';"
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
                            @click="links.push(newLink.trim());newLink='';" :disabled="newLink.trim().length===0"
                            aria-label="Add new link">
                            <x-icons.plus class="w-4 h-4" />
                        </button>
                    </div>
                </fieldset>
            </div>
            <!---links ends-->
            <div class="flex justify-end gap-x-5">
                <button type="button" class="btn" @click="$dispatch('close-modal')">Cancel</button>
                <button class="btn btn-primary p-3" type="submit">{{ $idea->exists ? 'Update' : 'Create' }}</button>
            </div>
        </div>
    </form>
    @if($idea->image_path)
        <form method="post" action="{{ route('idea.destroyImage', $idea) }}" id="delete-image-form">
            @csrf
            @method('DELETE')
        </form>
    @endif
</x-modal>