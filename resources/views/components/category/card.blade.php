@props([
    'title' => 'Kategori',
    'count' => 0,
    'logo' => null,
    'editUrl' => '#',
    'deleteUrl' => '#',
    'category' => null,
])

<div class="relative bg-white shadow hover:shadow-md transition rounded-xl overflow-hidden">

    <div class="h-36 bg-gray-100/50 flex items-center justify-center">
        <img src="{{ asset($logo ?? 'assets/images/logo/astacita/food_security_logo.png') }}"
            class="h-20 object-contain">
    </div>

    <div class="p-4">
        <h2 class="text-lg font-semibold">{{ $category->order_number }}. {{ $title }}</h2>
        <p class="text-gray-500 text-sm mt-1">
            {{ $count }} Statements
        </p>

        <div class="mt-3">
            <a href="{{ route('problem-statement.category.statements.index', $category->slug) }}"
                class="inline-block px-3 py-1 text-xs bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-full">
                View Detail →
            </a>
        </div>
    </div>

    <x-category.kebab-menu :category="$category" />
</div>