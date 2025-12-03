<x-app-layout>

    {{-- Notification --}}
    @if(session('success'))
        <x-notification type="success">
            {{ session('success') }}
        </x-notification>
    @endif

    @if(session('error'))
        <x-notification type="error">
            {{ session('error') }}
        </x-notification>
    @endif

    <div class="py-12">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold">{{ $category->order_number }}. {{ $category->name }}</h1>
                <p class="text-gray-500 text-sm mt-1">
                    Daftar statement pada kategori ini.
                </p>
            </div>

            {{-- Modal Component --}}
            <x-modal-add-edit title="Tambah Statement">

                <x-slot name="trigger">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        Tambah Statement
                    </button>
                </x-slot>

                <form action="{{ route('problem-statement.categories.statements.store', $category) }}" method="POST">
                    @csrf

                    {{-- Order Number with Category Prefix --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nomor Statement</label>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="px-3 py-2 bg-gray-100 border rounded-lg text-gray-700 font-medium">{{ $category->order_number }}.</span>
                            <input type="number" name="order_number" step="0.1" min="0.1" 
                                   value="{{ old('order_number') }}" 
                                   class="border rounded-lg w-full p-2 @error('order_number') border-red-500 @enderror" 
                                   placeholder="Contoh: 1" required>
                        </div>
                        @error('order_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Hasil: {{ $category->order_number }}.[nomor yang Anda masukkan]</p>
                    </div>

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Judul</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                               class="mt-1 border rounded-lg w-full p-2 @error('title') border-red-500 @enderror" 
                               placeholder="Masukan judul disini" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Deskripsi</label>
                        <textarea name="description" class="mt-1 border rounded-lg w-full p-2 @error('description') border-red-500 @enderror" rows="4" 
                                  placeholder="Deskripsi singkat..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CUSTOM BUTTONS --}}
                    <div class="flex justify-end gap-2 mt-4">

                        {{-- Ini tombol BATAL --}}
                        <button type="button" @click="$dispatch('close-modal')"
                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>

                        {{-- Tombol SIMPAN --}}
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>

                </form>

            </x-modal-add-edit>
        </div>

        {{-- Table Component --}}
        <x-statement.table :statements="$statements" :category="$category" />

    </div>

    {{-- Script to reopen modal if there are validation errors --}}
    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Trigger modal open event
                window.dispatchEvent(new CustomEvent('open-modal', { 
                    detail: { title: 'Tambah Statement' } 
                }));
            });
        </script>
    @endif

</x-app-layout>