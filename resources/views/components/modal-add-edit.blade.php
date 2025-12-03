@props(['title' => ''])

<div x-data="{ open: false }" 
     @close-modal.window="open = false"
     @open-modal.window="if ($event.detail.title === '{{ $title }}') { open = true }">

    {{-- Trigger --}}
    <div @click="open = true">
        {{ $trigger }}
    </div>

    {{-- Overlay --}}
    <div x-show="open" x-transition.opacity @click="open = false" class="fixed inset-0 bg-black/40 z-[900]">
    </div>

    {{-- Modal --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="fixed top-1/2 left-1/2
                -translate-x-1/2 -translate-y-1/2
                bg-white shadow-xl rounded-xl w-full max-w-lg p-6 z-[999]">

        <h2 class="text-xl font-semibold mb-4">{{ $title }}</h2>

        {{ $slot }}

    </div>
</div>