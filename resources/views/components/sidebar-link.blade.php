@props(['active' => false])

@php
$classes = $active
? 'flex items-center gap-3 p-2 rounded-lg bg-gray-100 text-blue-600 font-medium'
: 'flex items-center gap-3 p-2 rounded-lg text-gray-700 hover:bg-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>