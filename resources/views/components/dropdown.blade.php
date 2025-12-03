@props(['trigger', 'align' => 'right'])

<div x-data="{ open: false }" class="relative">
    {{-- Trigger --}}
    <div @click="open = !open" class="cursor-pointer">
        {{ $trigger }}
    </div>

    {{-- Dropdown --}}
    <div x-show="open" x-transition @click.away="open = false" class="absolute mt-2 w-48 bg-white rounded-lg shadow-lg border
        {{ $align === 'right' ? 'right-0' : 'left-0' }}">
        <div class="py-2">
            {{ $slot }}
        </div>
    </div>
</div>