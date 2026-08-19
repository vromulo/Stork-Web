<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- set the brand name in the .env file at APP_NAME -->
    <title> 
        {{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}
    </title>

    <!-- Google Fonts: DM Serif Display & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0,1&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="">

    <!-- Navigation Bar -->
    <header class="sticky top-0 z-50 flex flex-col w-full">
        @include('components.navbar')
        <x-category-filter />
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @if (!($hideFooter ?? false)) <!-- if $hideFooter is set to True, footer will be hidden -->
        @include('components.footer')
    @endif

    @livewireScripts

</body>
</html>