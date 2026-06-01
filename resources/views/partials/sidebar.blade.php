<aside
    class="fixed lg:relative left-0 top-0
    h-screen w-72 bg-white border-r border-gray-200
    transform lg:translate-x-0
    transition duration-300 z-40 lg:z-0
    overflow-y-auto"

    :class="sidebar ? 'translate-x-0' : '-translate-x-full'">

    <div class="px-6 py-4 border-b border-gray-200">
        <h1 class="text-sm font-semibold text-gray-900 tracking-wide">
            CMS ADMIN
        </h1>
    </div>

    <nav class="px-4 py-6 space-y-1">

        <a
            href="{{ route('dashboard') }}"
            class="block px-3 py-2 text-sm text-gray-700 rounded hover:bg-gray-50 transition">
            Dashboard
        </a>

        <a
            href="{{ route('content-pages.index') }}"
            class="block px-3 py-2 text-sm text-gray-700 rounded hover:bg-gray-50 transition">
            Content
        </a>

        <a
            href="{{ route('products.index') }}"
            class="block px-3 py-2 text-sm text-gray-700 rounded hover:bg-gray-50 transition">
            Products
        </a>

        <a
            href="{{ route('locations.index') }}"
            class="block px-3 py-2 text-sm text-gray-700 rounded hover:bg-gray-50 transition">
            Locations
        </a>

        <a
            href="{{ route('settings.index') }}"
            class="block px-3 py-2 text-sm text-gray-700 rounded hover:bg-gray-50 transition">
            Settings
        </a>

        <div class="pt-4 mt-4 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="w-full text-left px-3 py-2 text-sm text-gray-700 rounded hover:bg-gray-50 transition">
                    Logout
                </button>
            </form>
        </div>

    </nav>

</aside>