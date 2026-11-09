@props(['is' => 'a'])
<{{ $is }} {{ $attributes->merge(['class' => 'card block hover:border-gray-300 md:text-sm']) }}>
    {{ $slot }}
</{{ $is }}>