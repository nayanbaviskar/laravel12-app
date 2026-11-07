@props(['name', 'label', 'type' => 'text'])

<div class="space-y-1.5">
    <label for="{{ $name }}" class="block text-sm font-medium text-zinc-700">
        {{ $label }}
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name) }}"
        {{ $attributes->merge([
            'class' => 'block w-full rounded-lg border bg-white px-3.5 py-2.5 text-sm text-zinc-900 shadow-xs placeholder:text-zinc-400 focus:outline-none transition-colors ' .
                ($errors->has($name)
                    ? 'border-red-400 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-red-900'
                    : 'border-zinc-300 focus:border-zinc-900 focus:ring-1 focus:ring-zinc-900')
        ]) }}
    />

    @error($name)
        <p class="text-xs font-medium text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
