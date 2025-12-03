<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200
        transition-transform duration-300 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    <div class="p-4">
        <img src="{{ asset('assets/images/logo/Ditjen Risbang.png') }}" alt="Logo" class="w-28 mx-auto">
    </div>

    <nav class="mt-4 space-y-2 px-3">

        <x-sidebar-link :active="request()->routeIs('problem-statement.category.index') ||
                     request()->routeIs('problem-statement.category.index')"
            href="{{ route('problem-statement.category.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                <path fill="currentColor"
                    d="M7 16q.425 0 .713-.288T8 15t-.288-.712T7 14t-.712.288T6 15t.288.713T7 16m0-3q.425 0 .713-.288T8 12V9q0-.425-.288-.712T7 8t-.712.288T6 9v3q0 .425.288.713T7 13m4 2h6q.425 0 .713-.288T18 14t-.288-.712T17 13h-6q-.425 0-.712.288T10 14t.288.713T11 15m0-4h6q.425 0 .713-.288T18 10t-.288-.712T17 9h-6q-.425 0-.712.288T10 10t.288.713T11 11m-7 9q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20z" />
            </svg>
            Rumusan Masalah
        </x-sidebar-link>

    </nav>

</aside>