<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storkia - Logistics Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="m-0 p-0 h-screen w-screen flex font-sans antialiased text-text-main overflow-hidden bg-surface">
    
    <x-auth.login-form 
        title="Logistics Operations" 
        subtitle="Sign in to your courier dashboard"
        :submitRoute="route('login.post')"
        :showRegister="false"
    />

    @livewireScripts
</body>
</html>