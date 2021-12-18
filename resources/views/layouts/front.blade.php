<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/front.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

    @livewireStyles

    <!-- Scripts -->
</head>

<body class="bg-gray-200 dark:bg-gray-700">
    <x-navbar />
    {{ $slot }}
    <x-footer />
    @stack('modals')
    @livewireScripts
</body>

</html>
