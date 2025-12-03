@props([
    'statements' => [],
    'category' => null,
])

{{-- Tabel Statement --}}
<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    
    {{-- Wrapper for horizontal scroll on mobile --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr class="text-left text-gray-700 text-sm">
                    <th class="py-3 px-4 w-24">Nomor</th>
                    <th class="py-3 px-4">Judul</th>
                    <th class="py-3 px-4">Deskripsi</th>
                    <th class="py-3 px-4">Dibuat</th>
                    <th class="py-3 px-4">Diupdate</th>
                    <th class="py-3 px-4 text-center w-36">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($statements as $statement)
                    <x-statement.row 
                        :order="$statement->full_number" 
                        :title="$statement->title" 
                        :description="$statement->description ?? '-'" 
                        :created="$statement->created_at->diffForHumans()" 
                        :updated="$statement->updated_at->diffForHumans()" 
                        :statement="$statement"
                        :category="$category" />
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500">
                            Belum ada statement. Klik "Tambah Statement" untuk menambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
</div>