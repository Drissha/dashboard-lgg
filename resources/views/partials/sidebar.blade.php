<aside
    class="fixed lg:relative left-0 top-0 rounded-t-xl
    h-screen w-72 bg-white border-r border-gray-200
    transform lg:translate-x-0
    transition duration-300 z-40 lg:z-0
    overflow-y-auto"

    :class="sidebar ? 'translate-x-0' : '-translate-x-full'">

    <div class="px-6 py-4 border-b bg-[#9FA1FF] border-gray-200">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-15 w-auto">
    </div>

    <nav class="space-y-1">

        <a
            href="{{ route('dashboard') }}"
            class="block px-6 py-4 text-md text-gray-700 rounded hover:bg-[#B5BAFF] hover:text-white transition">
            Dashboard
        </a>

        <a
            href="{{ route('content-pages.index') }}"
            class="block px-6 py-4 text-md text-gray-700 rounded hover:bg-[#B5BAFF] hover:text-white transition">
            Content
        </a>

        <a
            href="{{ route('promotions.index') }}"
            class="block px-6 py-4 text-md text-gray-700 rounded hover:bg-[#B5BAFF] hover:text-white transition">
            Promotions
        </a>

        <a
            href="{{ route('admin.blogs.index') }}"
            class="block px-6 py-4 text-md text-gray-700 rounded hover:bg-[#B5BAFF] hover:text-white transition">
            Blogs
        </a>

        <a
            href="{{ route('products.index') }}"
            class="block px-6 py-4 text-md text-gray-700 rounded hover:bg-[#B5BAFF] hover:text-white transition">
            Products
        </a>

        <a
            href="{{ route('locations.index') }}"
            class="block px-6 py-4 text-md text-gray-700 rounded hover:bg-[#B5BAFF] hover:text-white transition">
            Locations
        </a>

        <a
            href="{{ route('settings.index') }}"
            class="block px-6 py-4 text-md text-gray-700 rounded hover:bg-[#B5BAFF] hover:text-white transition">
            Settings
        </a>

        <div class="pt-4 mt-4 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="w-full text-left px-6 py-4 text-md text-gray-700 rounded hover:bg-[#9FA1FF] transition">
                    Logout
                </button>
            </form>
        </div>

    </nav>

</aside>
