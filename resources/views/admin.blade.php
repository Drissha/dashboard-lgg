<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script defer src="//unpkg.com/alpinejs"></script>
</head>
<body class="bg-gray-50">

<div x-data="{ sidebar:false }" class="min-h-screen">

    <!-- Mobile Header -->
    <div class="lg:hidden bg-white border-b p-4 flex justify-between">
        <h1 class="font-bold text-xl">CMS Admin</h1>

        <button @click="sidebar=true">
            ☰
        </button>
    </div>

    <!-- Overlay -->
    <div
        x-show="sidebar"
        @click="sidebar=false"
        class="fixed inset-0 bg-black/50 z-40 lg:hidden">
    </div>

    <div class="flex">

        @include('partials.sidebar')

        <main class="flex-1 p-6 lg:p-10">

            @if(session('success'))
                <div class="mb-5 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>