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

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">Kategori</h1>

            {{-- Modal Add Category --}}
            <x-modal-add-edit title="Tambah Kategori">

                {{-- Tombol Trigger --}}
                <x-slot name="trigger">
                    <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Tambah Kategori
                    </button>
                </x-slot>

                {{-- FORM Tambah Kategori --}}
                <form action="{{ route('problem-statement.categories.store') }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    {{-- Nomor Urutan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nomor Urutan</label>
                        <input type="number" name="order_number" value="{{ old('order_number') }}" 
                               class="mt-1 border rounded-lg w-full p-2 @error('order_number') border-red-500 @enderror"
                               placeholder="Contoh: 1">
                        @error('order_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Kategori --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nama Kategori</label>
                        <input type="text" value="{{ old('name') }}" name="name" class="w-full mt-1 border rounded-lg p-2 @error('name') border-red-500 @enderror"
                            placeholder="Contoh: Pangan">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Logo Upload with Preview --}}
                    <div x-data="{ preview: null }" class="mb-4">
                        <label class="block text-sm font-medium">Logo</label>

                        {{-- Preview Gambar --}}
                        <div class="mt-2" x-show="preview">
                            <img :src="preview" class="h-20 w-20 object-cover rounded-lg border mb-2">
                        </div>

                        {{-- Input File (Hidden) --}}
                        <input type="file" name="image" id="categoryLogoInput" class="hidden" accept="image/*" @change="
                            const file = $event.target.files[0];
                            if(file){
                                preview = URL.createObjectURL(file);
                            }
                        ">

                        <div class="flex gap-2 mt-2">

                            {{-- Upload / Ganti Logo --}}
                            <button type="button" onclick="document.getElementById('categoryLogoInput').click()"
                                class="px-3 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                <span x-show="!preview">Upload Logo</span>
                                <span x-show="preview">Ganti Logo</span>
                            </button>

                            {{-- Hapus Logo --}}
                            <button type="button" x-show="preview" @click="
                                    preview = null;
                                    document.getElementById('categoryLogoInput').value = '';
                                " class="px-3 py-2 bg-red-100 text-red-600 rounded hover:bg-red-200">
                                Hapus
                            </button>

                        </div>

                        {{-- Error Message --}}
                        @error('image')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-2 mt-4">

                        {{-- Tombol Batal --}}
                        <button type="button" @click="$dispatch('close-modal')"
                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>

                        {{-- Tombol Simpan --}}
                        <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>

                </form>

            </x-modal-add-edit>
        </div>

        {{-- Grid Card --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
                <x-category.card :title="$category->name" :count="$category->statements_count"
                    :logo="$category->image ? 'storage/'.$category->image : null"
                    :category="$category" />
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Kategori</h3>
                        <p class="text-gray-500 mb-4">Mulai dengan menambahkan kategori pertama Anda.</p>
                        <p class="text-sm text-gray-400">Klik tombol "Tambah Kategori" di atas untuk membuat kategori baru.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Script to reopen modal if there are validation errors --}}
    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Trigger modal open event
                window.dispatchEvent(new CustomEvent('open-modal', { 
                    detail: { title: 'Tambah Kategori' } 
                }));
            });
        </script>
    @endif

</x-app-layout>