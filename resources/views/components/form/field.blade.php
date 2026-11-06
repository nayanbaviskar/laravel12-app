@props(['name', 'label', 'type' => 'text'])

<div class="space-y-2">
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    <input type={{ $type }} name= {{ $name }} id={{ $name }} value="{{ old($name) }}"  $attributes />

    @error($name)
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>