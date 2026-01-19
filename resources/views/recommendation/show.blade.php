<x-app-layout title="Rekomendasi - {{ $category->name }}">

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

        {{-- Header with Back Button --}}
        <div class="flex items-center gap-4 mb-6">
            <div class="flex items-center gap-3">
                @if($category->image)
                    <img src="{{ asset('storage/'.$category->image) }}" 
                         alt="{{ $category->name }}" 
                         class="w-12 h-12 object-contain">
                @endif
                <h1 class="text-2xl font-semibold">Rekomendasi {{ $category->name }}</h1>
            </div>
        </div>

        {{-- Accordion List --}}
        <div class="space-y-6">
            
            {{-- Accordion Item 1 --}}
            <div x-data="{ open: false }" class="bg-white rounded-xl overflow-hidden">
                
                {{-- Accordion Header --}}
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between p-6 hover:bg-gray-50 transition-colors">
                    
                    {{-- Left: Number + Title --}}
                    <div class="flex items-center gap-4">
                        <span class="text-lg font-semibold text-blue-600">1.1</span>
                        <h3 class="text-lg font-semibold text-gray-900">Judul Rekomendasi Pertama</h3>
                    </div>
                    
                    {{-- Right: Arrow Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-6 w-6 text-gray-400 transition-transform duration-200"
                         :class="{ 'rotate-180': open }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                {{-- Accordion Content --}}
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="border-t border-gray-200">
                    <div class="p-6">
                    
                        <div>
                            <button class="px-4 py-2 mb-8 inline-flex text-sm leading-5 font-semibold rounded-md bg-blue-500 text-white hover:bg-blue-600 transition-colors">Reset Rekomendasi</button>
                        </div>

                        {{-- Table --}}
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Judul
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Item 1</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Deskripsi item pertama</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button class="py-2 px-4 inline-flex text-xs leading-5 font-semibold rounded-md bg-red-500 text-white">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>

            {{-- Accordion Item 2 --}}
            <div x-data="{ open: false }" class="bg-white rounded-xl overflow-hidden">
                
                {{-- Accordion Header --}}
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between p-6 hover:bg-gray-50 transition-colors">
                    
                    {{-- Left: Number + Title --}}
                    <div class="flex items-center gap-4">
                        <span class="text-lg font-semibold text-blue-600">1.2</span>
                        <h3 class="text-lg font-semibold text-gray-900">Judul Rekomendasi Kedua</h3>
                    </div>
                    
                    {{-- Right: Arrow Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-6 w-6 text-gray-400 transition-transform duration-200"
                         :class="{ 'rotate-180': open }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                {{-- Accordion Content --}}
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="border-t border-gray-200">
                    <div class="p-6">
                        
                        {{-- Table --}}
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Deskripsi
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Item A</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Deskripsi item A</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
