@props(['status' => 'pending'])

@php
    $classes = 'inline-block rounded-full border px-2.5 py-0.5 text-xs font-medium ';

    if ($status == 'pending') {
        $classes .= 'bg-yellow-50 text-yellow-700 border-yellow-200';
    }
    if ($status == 'in_progress') {
        $classes .= 'bg-blue-50 text-blue-700 border-blue-200';
    }
    if ($status == 'completed') {
        $classes .= 'bg-green-50 text-green-700 border-green-200';
    }
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>

