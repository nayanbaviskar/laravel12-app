@props(['name', 'label', 'type' => 'text'])

<div class="space-y-1.5">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name) }}"
        {{ $attributes->merge([
            'class' => 'form-input ' . ($errors->has($name) ? 'border-red-400 focus:border-red-500 focus:ring-red-500 text-red-900' : '')
        ]) }}
    />

    @error($name)
        <p class="text-xs font-medium text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
