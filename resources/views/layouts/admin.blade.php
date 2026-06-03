<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin LGG</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script defer src="//unpkg.com/alpinejs"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>
</head>
<body class="bg-gray-50">

<div x-data="{ sidebar: false }" class="flex h-screen">

    <!-- Mobile Header -->
    <div class="fixed top-0 left-0 right-0 lg:hidden bg-white border-b border-gray-200 px-4 py-3 flex justify-between items-center z-40">
        <h1 class="text-sm font-semibold text-gray-900">CMS ADMIN</h1>

        <button @click="sidebar=!sidebar" class="p-2 hover:bg-gray-100 rounded text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Overlay -->
    <div
        x-show="sidebar"
        @click="sidebar=false"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden">
    </div>

    <!-- Sidebar -->
    @include('partials.sidebar')

    
    <!-- Main Content -->
    <main class="flex-1 overflow-auto pt-0 lg:pt-0">
        {{-- Navbar --}}
        @include('partials.navbar')
        <div class="hidden lg:block"></div>
        <div class="lg:hidden h-14"></div>

        <div class="p-4 sm:p-6 lg:p-8 space-y-6">
            @if($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <div class="font-semibold mb-2">Please fix the following:</div>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

</div>

<script>
    tinymce.init({
        selector:'#content',
        height:500,
        menubar:true,
        plugins:'link image code table lists',
        toolbar:'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | code'
    });

    document.addEventListener('change', function (event) {
        const input = event.target;

        if (!input.matches('input[type="file"][data-preview-target]')) {
            return;
        }

        const target = document.getElementById(input.dataset.previewTarget);
        if (!target || !input.files || !input.files[0]) {
            return;
        }

        const file = input.files[0];
        const reader = new FileReader();

        if (target.tagName === 'DIV' && input.multiple) {
            target.innerHTML = '';

            Array.from(input.files).forEach(function (selectedFile) {
                const imageReader = new FileReader();

                imageReader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview image';
                    img.className = 'w-32 h-32 object-cover rounded-xl border border-gray-200';
                    target.appendChild(img);
                };

                imageReader.readAsDataURL(selectedFile);
            });

            target.classList.remove('hidden');
            return;
        }

        reader.onload = function (e) {
            target.src = e.target.result;
            target.classList.remove('hidden');
        };

        reader.readAsDataURL(file);
    });
</script>

</body>
</html>
