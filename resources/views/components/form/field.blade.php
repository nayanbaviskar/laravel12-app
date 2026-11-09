@props(['name', 'label' => false, 'type' => 'text'])

<div class="space-y-1.5">
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>
    @endif
    @if($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" class="textarea" {{ $attributes->merge([
            'class' => 'textarea ' . ($errors->has($name) ? 'border-red-400 focus:border-red-500 focus:ring-red-500 text-red-900' : '')
        ]) }}>{{ old($name) }}</textarea>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}" {{ $attributes->merge([
            'class' => 'form-input ' . ($errors->has($name) ? 'border-red-400 focus:border-red-500 focus:ring-red-500 text-red-900' : '')
        ]) }} />
    @endif
    <x-form.error name={{ $name }} />
</div>