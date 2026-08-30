<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | {{ config('app.name', 'Storkia') }}</title>
    
    <!-- Google Fonts: DM Serif Display & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0,1&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Use surface-subtle for the clean, light-gray background -->
<body class="bg-surface-subtle font-sans text-text-main antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    
    @yield('content')

</body>
</html>