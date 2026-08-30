<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storkia - Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        .rounded-scrollbar::-webkit-scrollbar { width: 6px; }
        .rounded-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .rounded-scrollbar::-webkit-scrollbar-thumb { background-color: var(--color-primary, #CF4173); border-radius: 9999px; }
        .rounded-scrollbar::-webkit-scrollbar-thumb:hover { background-color: var(--color-primary-dark, #5D3140); }
    </style>
</head>
<body class="m-0 p-0 h-screen w-screen flex font-sans antialiased text-text-main overflow-hidden bg-surface">

    <x-carousel />

    <div class="w-1/2 h-full flex flex-col items-center justify-start p-8 lg:p-12 bg-gradient-to-br from-surface-subtle via-surface to-brand-light/30 overflow-y-auto rounded-scrollbar">
        <div class="w-full max-w-2xl bg-surface/90 backdrop-blur-sm p-8 rounded-[2rem] shadow-xl border border-border-subtle my-auto">

            <div class="text-center mb-8">
                <a href="/" wire:navigate class="text-4xl font-serif text-primary-dark tracking-tight hover:text-primary transition-colors inline-block mb-1">Storkia</a>
                <h1 class="text-2xl font-bold text-text-main">Create your Profile</h1>
                <p class="text-text-muted mt-1 text-sm">Please fill in the details below to join us.</p>
            </div>

            <livewire:auth.register-wizard />

            <p class="mt-6 text-center text-xs text-text-muted">
                Already have an account?
                <a href="{{ route('login') }}" wire:navigate class="font-bold text-primary hover:text-primary-dark transition-colors">Sign in here</a>
            </p>
        </div>
    </div>

    @livewireScripts
</body>
</html>