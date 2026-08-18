<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> <!-- set the brand name in the .env file at APP_NAME -->
        {{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="">

    <!-- Navigation Bar -->
    @include('components.navbar')

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