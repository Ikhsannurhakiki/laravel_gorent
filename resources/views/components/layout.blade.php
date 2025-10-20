<html class="bg-white dark:bg-gray-950 scheme-light dark:scheme-dark">

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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    {{-- CSS stack --}}
    @stack('style')
    {{-- <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" /> --}}

</head>
<x-navbar />

<body class="h-full">
    <div class="min-h-full">
        {{ $slot }}
    </div>
    {{-- Javascript stacks --}}
    @stack('script')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

</body>

</html>
