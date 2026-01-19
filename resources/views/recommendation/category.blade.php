<x-app-layout title="Kategori - Rekomendasi">

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
            <h1 class="text-2xl font-semibold">Rekomendasi</h1>
        </div>

        {{-- Grid Card --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
                <a href="{{ route('recommendation.show', $category->slug) }}" 
                   class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    
                    {{-- Logo --}}
                    @if($category->image)
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('storage/'.$category->image) }}" 
                                 alt="{{ $category->name }}" 
                                 class="h-20 w-20 object-contain">
                        </div>
                    @endif

                    {{-- Title --}}
                    <h3 class="text-lg font-semibold text-center mb-2">{{ $category->name }}</h3>

                    {{-- Count --}}
                    <p class="text-sm text-gray-500 text-center">
                        {{ $category->statements_count }} Rekomendasi
                    </p>
                </a>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Kategori</h3>
                        <p class="text-gray-500 mb-4">Kategori rekomendasi akan muncul di sini.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</x-app-layout>
