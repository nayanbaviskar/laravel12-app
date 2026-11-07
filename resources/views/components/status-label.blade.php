@props(['status' => 'pending'])

@php
    $classes = 'badge ';

    if ($status == 'pending') {
        $classes .= 'badge-yellow';
    }
    if ($status == 'in_progress') {
        $classes .= 'badge-blue';
    }
    if ($status == 'completed') {
        $classes .= 'badge-green';
    }
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>