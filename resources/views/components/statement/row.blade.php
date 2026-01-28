<tr class="hover:bg-gray-50">
    <td class="py-3 px-4">{{ $order ?? '1' }}</td>
    
    {{-- Judul with Read More --}}
    <td class="py-3 px-4">
        <div x-data="{ expanded: false }" class="flex items-start gap-2">
            <div class="flex-1">
                <div x-show="!expanded">
                    <span>{{ Str::limit($title ?? 'Judul Statement', 50) }}</span>
                </div>
                <div x-show="expanded" x-cloak>
                    <span>{{ $title ?? 'Judul Statement' }}</span>
                </div>
            </div>
            @if(strlen($title ?? 'Judul Statement') > 50)
                <button @click="expanded = !expanded" class="text-gray-400 hover:text-gray-600 flex-shrink-0 mt-1">
                    <svg x-show="!expanded" class="w-4 h-4" viewBox="0 0 512 512" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="m136 208l120-104l120 104m-240 96l120 104l120-104"/>
                    </svg>
                    <svg x-show="expanded" x-cloak class="w-4 h-4" viewBox="0 0 512 512" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="m136 208l120-104l120 104m-240 96l120 104l120-104"/>
                    </svg>
                </button>
            @endif
        </div>
    </td>
    
    {{-- Deskripsi with Read More --}}
    <td class="py-3 px-4 text-gray-600">
        <div x-data="{ expanded: false }" class="flex items-start gap-2">
            <div class="flex-1">
                <div x-show="!expanded">
                    <span>{{ Str::limit($description ?? 'Deskripsi...', 100) }}</span>
                </div>
                <div x-show="expanded" x-cloak>
                    <span>{{ $description ?? 'Deskripsi...' }}</span>
                </div>
            </div>
            @if(strlen($description ?? 'Deskripsi...') > 100)
                <button @click="expanded = !expanded" class="text-gray-400 hover:text-gray-600 flex-shrink-0 mt-1">
                    <svg x-show="!expanded" class="w-4 h-4" viewBox="0 0 512 512" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="m136 208l120-104l120 104m-240 96l120 104l120-104"/>
                    </svg>
                    <svg x-show="expanded" x-cloak class="w-4 h-4" viewBox="0 0 512 512" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="m136 208l120-104l120 104m-240 96l120 104l120-104"/>
                    </svg>
                </button>
            @endif
        </div>
    </td>
    
    <td class="py-3 px-4 text-gray-600">{{ $created ?? '2 hari lalu' }}</td>
    <td class="py-3 px-4 text-gray-600">{{ $updated ?? '1 hari lalu' }}</td>

    {{-- Recommendations Column --}}
    <td class="py-3 px-4 text-center">
        @if($statement->recommendation)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                {{ $statement->recommendation->count }} penelitian
            </span>
        @else
            <form action="{{ route('problem-statement.statements.recommendations.generate', $statement) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                    Generate
                </button>
            </form>
        @endif
    </td>

    <td class="py-3 px-4 flex justify-end gap-2">
        <x-modal-add-edit title="Edit Statement">

            {{-- Trigger --}}
            <x-slot name="trigger">
                <button class="px-3 py-1 text-sm bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200">
                    Edit
                </button>
            </x-slot>

            {{-- Content / Form --}}
            <form action="{{ route('problem-statement.statements.update', $statement) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Order Number with Category Prefix --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nomor Statement</label>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="px-3 py-2 bg-gray-100 border rounded-lg text-gray-700 font-medium">{{ $category->order_number }}.</span>
                        <input type="number" name="order_number" step="0.1" min="0.1" 
                               value="{{ old('order_number', $statement->order_number) }}"
                               class="border rounded-lg w-full p-2" required>
                    </div>
                </div>

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $statement->title) }}"
                        class="mt-1 w-full border rounded-lg p-2" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="mt-1 w-full border rounded-lg p-2">{{ old('description', $statement->description) }}</textarea>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-2 mt-4">

                    {{-- Batal --}}
                    <button type="button" @click="$dispatch('close-modal')"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>

                    {{-- Update --}}
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update
                    </button>

                </div>

            </form>

        </x-modal-add-edit>

        <x-modal-confirm :action="route('problem-statement.statements.destroy', $statement)" message="Hapus statement ini?">
            <x-slot name="trigger">
                <button class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200">
                    Hapus
                </button>
            </x-slot>
        </x-modal-confirm>
    </td>
</tr>