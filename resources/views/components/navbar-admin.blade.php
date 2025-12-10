<header class="h-14 bg-white border-b border-gray-200 flex items-center justify-between px-4
           fixed top-0 right-0 z-40 w-full lg:ml-64">

    {{-- Mobile Sidebar Toggle --}}
    <button @click="sidebarOpen = true" class="lg:hidden mr-2 text-2xl">
        ☰
    </button>

    {{-- Right Panel --}}
    <div class="flex items-center justify-end w-full gap-4">

        <x-dropdown align="right">
            <x-slot name="trigger">
                <img src="{{ asset('assets/images/logo/kementerian.png') }}" class="w-10 h-10 rounded-full border cursor-pointer">
            </x-slot>

            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('profile.edit') }}">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </x-dropdown>

    </div>
</header>