<!DOCTYPE html>
<html class="bg-white dark:bg-gray-950 scheme-light dark:scheme-dark"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    @livewireStyles

    @stack('style')
</head>
<x-navbar />

<body class="h-full">
    <div class="min-h-full">
        {{ $slot }}
    </div>
    {{-- Javascript stacks --}}
    @stack('script')
    @livewireScripts
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('modal', {
                open: false,
                isEdit: false
            });

            window.addEventListener('openbusinessmodalupdate', () => {
                setTimeout(() => {
                    Alpine.store('modal').open = true;
                    Alpine.store('modal').isEdit = true;
                }, 10);
            });

            window.addEventListener('openbusinessmodalcreate', () => {
                setTimeout(() => {
                    Alpine.store('modal').open = true;
                    Alpine.store('modal').isEdit = false;
                }, 10);
            });

            window.addEventListener('closemodal', () => {
                setTimeout(() => {
                    Alpine.store('modal').open = false;
                    Alpine.store('modal').isEdit = false;
                }, 150);
            });


            window.addEventListener('keepmodalopen', () => {
                Alpine.store('modal').open = true;
            });

            window.addEventListener('openupdatebusiness', (event) => {
                const id = event.detail?.id;
                if (id) {
                    Livewire.dispatch('openupdatebusiness', {
                        id
                    });
                }
                Alpine.store('modal').open = true;
                Alpine.store('modal').isEdit = true;
            });
        });
    </script>

</body>

</html>
