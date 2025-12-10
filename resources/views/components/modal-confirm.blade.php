@props([
'action' => '#',
'message' => 'Apakah Anda yakin ingin menghapus item ini?',
])

<div x-data="{ open: false }">

    {{-- Trigger --}}
    <div @click="open = true">
        {{ $trigger }}
    </div>

    {{-- Overlay --}}
    <div x-show="open" x-transition.opacity @mousedown.self="open = false" class="fixed inset-0 bg-black/40 z-[900]">
    </div>

    {{-- Modal Box --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                bg-white shadow-xl rounded-xl w-full max-w-sm p-6 z-[999]">

        <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>

        <p class="text-gray-600 mb-6">
            {{ $message }}
        </p>

        <div class="flex justify-end gap-3">

            {{-- Cancel --}}
            <button type="button" @click="open = false" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                Batal
            </button>

            {{-- Delete --}}
            <form method="POST" action="{{ $action }}">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Hapus
                </button>
            </form>
        </div>

    </div>

</div>