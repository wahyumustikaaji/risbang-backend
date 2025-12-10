@props([
'category', // instance App\Models\Category
])

<div x-data="{ open: false }" 
     @open-modal.window="open = false"
     @close-modal.window="open = false"
     class="absolute top-3 right-3 text-gray-700">

    {{-- Tombol 3 titik --}}
    <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
            <g fill="currentColor">
                <circle cx="10" cy="15" r="2" />
                <circle cx="10" cy="10" r="2" />
                <circle cx="10" cy="5" r="2" />
            </g>
        </svg>
    </button>

    {{-- Dropdown --}}
    <div x-show="open" x-transition
        class="absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-40 text-sm z-50">

        {{-- EDIT --}}
        <x-modal-add-edit :title="'Edit Kategori'">

            {{-- Trigger (item edit di dropdown) --}}
            <x-slot name="trigger">
                <button type="button"
                    class="w-full flex items-center gap-2 text-left px-4 py-2 hover:bg-gray-50 text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                        <g fill="currentColor">
                            <path
                                d="M2 6.857A4.857 4.857 0 0 1 6.857 2H12a1 1 0 1 1 0 2H6.857A2.857 2.857 0 0 0 4 6.857v10.286A2.857 2.857 0 0 0 6.857 20h10.286A2.857 2.857 0 0 0 20 17.143V12a1 1 0 1 1 2 0v5.143A4.857 4.857 0 0 1 17.143 22H6.857A4.857 4.857 0 0 1 2 17.143z" />
                            <path
                                d="m15.137 13.219l-2.205 1.33l-1.033-1.713l2.205-1.33l.003-.002a1.2 1.2 0 0 0 .232-.182l5.01-5.036a3 3 0 0 0 .145-.157c.331-.386.821-1.15.228-1.746c-.501-.504-1.219-.028-1.684.381a6 6 0 0 0-.36.345l-.034.034l-4.94 4.965a1.2 1.2 0 0 0-.27.41l-.824 2.073a.2.2 0 0 0 .29.245l1.032 1.713c-1.805 1.088-3.96-.74-3.18-2.698l.825-2.072a3.2 3.2 0 0 1 .71-1.081l4.939-4.966l.029-.029c.147-.15.641-.656 1.24-1.02c.327-.197.849-.458 1.494-.508c.74-.059 1.53.174 2.15.797a2.9 2.9 0 0 1 .845 1.75a3.15 3.15 0 0 1-.23 1.517c-.29.717-.774 1.244-.987 1.457l-5.01 5.036q-.28.281-.62.487" />
                        </g>
                    </svg>
                    Edit
                </button>
            </x-slot>

            {{-- FORM EDIT KATEGORI --}}
            <form action="{{ route('problem-statement.categories.update', $category) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nomor Kategori --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nomor Kategori</label>
                    <input type="number" name="order_number" value="{{ old('order_number', $category->order_number) }}"
                        class="mt-1 border rounded-lg w-full p-2 @error('order_number') border-red-500 @enderror">
                    @error('order_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama kategori --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}"
                        class="w-full mt-1 border rounded-lg p-2 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Logo Upload with Preview --}}
                <div x-data="{ preview: '{{ $category->image ? asset('storage/'.$category->image) : null }}' }" class="mb-4">
                    <label class="block text-sm font-medium">Logo</label>

                    {{-- Preview Gambar --}}
                    <div class="mt-2" x-show="preview">
                        <img :src="preview" class="h-20 w-20 object-cover rounded-lg border mb-2">
                    </div>

                    {{-- Input File (Hidden) --}}
                    <input type="file" name="image" id="categoryLogoEditInput{{ $category->id }}" class="hidden" accept="image/*" @change="
                        const file = $event.target.files[0];
                        if(file){
                            preview = URL.createObjectURL(file);
                        }
                    ">

                    <div class="flex gap-2 mt-2">

                        {{-- Upload / Ganti Logo --}}
                        <button type="button" onclick="document.getElementById('categoryLogoEditInput{{ $category->id }}').click()"
                            class="px-3 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                            <span x-show="!preview">Upload Logo</span>
                            <span x-show="preview">Ganti Logo</span>
                        </button>

                        {{-- Hapus Logo --}}
                        <button type="button" x-show="preview" @click="
                                preview = null;
                                document.getElementById('categoryLogoEditInput{{ $category->id }}').value = '';
                            " class="px-3 py-2 bg-red-100 text-red-600 rounded hover:bg-red-200">
                            Hapus
                        </button>

                    </div>

                    {{-- Error Message --}}
                    @error('image')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" @click="$dispatch('close-modal')"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update
                    </button>
                </div>

            </form>

        </x-modal-add-edit>

        {{-- DELETE --}}
        <x-modal-confirm :action="route('problem-statement.categories.destroy', $category)"
            message="Yakin ingin menghapus kategori ini?">

            <x-slot name="trigger">
                <button type="button"
                    class="w-full flex items-center gap-2 text-left px-4 py-2 hover:bg-red-50 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 448 512">
                        <path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16
                              16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16M53.2 467a48
                              48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z" />
                    </svg>
                    Hapus
                </button>
            </x-slot>

        </x-modal-confirm>

    </div>
</div>