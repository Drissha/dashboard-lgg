<header class="bg-white border-b px-6 py-4">

    <div class="flex items-center justify-between">

        <div>
            <h2 class="text-xl font-semibold">
                Admin Dashboard
            </h2>
        </div>

        {{-- <div x-data="{ open:false }" class="relative">

            <button
                @click="open=!open"
                class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">

                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                </div>

                <div class="text-left">

                    <p class="font-medium">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        {{ auth()->user()->email }}
                    </p>

                </div>

            </button>

            <div
                x-show="open"
                @click.away="open=false"
                class="absolute right-0 mt-2 w-56 bg-white border rounded-xl shadow-lg">

                <a
                    href="{{ route('profile.show') }}"
                    class="block px-4 py-3 hover:bg-gray-50">

                    My Profile

                </a>

                <a
                    href="{{ route('profile.edit') }}"
                    class="block px-4 py-3 hover:bg-gray-50">

                    Edit Profile

                </a>

                <hr>

                <form
                    method="POST"
                    action="{{ route('logout') }}">

                    @csrf

                    <button
                        class="w-full text-left px-4 py-3 text-red-500 hover:bg-red-50">

                        Logout

                    </button>

                </form>

            </div>

        </div> --}}

    </div>

</header>