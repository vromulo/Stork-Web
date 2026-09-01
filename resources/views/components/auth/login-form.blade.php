@props([
    'title' => 'Welcome Back',
    'subtitle' => 'Please sign in to your account',
    'submitRoute' => route('login.post'),
    'registerRoute' => route('register'),
    'registerText' => 'Create one',
    'showRegister' => true
])

<div class="hidden lg:block lg:w-1/2 h-full">
    <x-carousel />
</div>
<div class="w-full lg:w-1/2 h-full flex flex-col items-center justify-center p-4 sm:p-8 lg:p-12 bg-gradient-to-br from-surface-subtle via-surface to-brand-light/30">
    
    <div class="w-full max-w-md bg-surface/90 backdrop-blur-sm p-6 sm:p-10 rounded-2xl sm:rounded-[2rem] shadow-xl border border-border-subtle">
        
        <div class="text-center mb-6 sm:mb-8">
            <a href="/" wire:navigate class="inline-block mb-2 cursor-pointer">
                <img src="{{ asset('assets/storkia-maximized.png') }}" alt="Storkia Logo" class="h-12 sm:h-16 w-auto mx-auto drop-shadow-md hover:drop-shadow-lg transition-all">
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-text-main">{{ $title }}</h1>
            <p class="text-text-muted mt-1 text-xs sm:text-sm">{{ $subtitle }}</p>
            
            @if ($errors->any())
                <p class="text-danger text-sm mt-2 font-bold">{{ $errors->first() }}</p>
            @endif
        </div>

        <form action="{{ $submitRoute }}" method="POST" class="space-y-4 sm:space-y-5">
            @csrf
            
            <div>
                <label for="email" class="block text-xs sm:text-sm font-bold text-text-main mb-1">Email Address</label>
                <div class="flex items-center w-full border-2 border-border-subtle rounded-xl bg-surface focus-within:border-text-main focus-within:ring-1 focus-within:ring-text-main transition-all overflow-hidden shadow-sm">
                    <div class="pl-3 sm:pl-4 pr-2 py-2.5 sm:py-3 flex items-center justify-center text-text-muted">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input type="email" id="email" name="email" class="w-full py-2.5 sm:py-3 pr-4 bg-transparent outline-none text-text-main text-sm sm:text-base" placeholder="you@example.com" required>
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs sm:text-sm font-bold text-text-main mb-1">Password</label>
                <div class="flex items-center w-full border-2 border-border-subtle rounded-xl bg-surface focus-within:border-text-main focus-within:ring-1 focus-within:ring-text-main transition-all overflow-hidden shadow-sm">
                    <div class="pl-3 sm:pl-4 pr-2 py-2.5 sm:py-3 flex items-center justify-center text-text-muted">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" id="password" name="password" class="w-full py-2.5 sm:py-3 pr-4 bg-transparent outline-none text-text-main text-sm sm:text-base" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="w-full py-2.5 sm:py-3 px-4 mt-4 sm:mt-6 bg-primary hover:bg-primary-dark text-surface text-base sm:text-lg font-bold rounded-xl shadow-md transition-colors cursor-pointer">
                Sign In
            </button>
        </form>

        @if($showRegister)
            <p class="mt-6 sm:mt-8 text-center text-xs sm:text-sm text-text-muted">
                Don't have an account? 
                <a href="{{ $registerRoute }}" wire:navigate class="font-bold text-primary hover:text-primary-dark transition-colors cursor-pointer">{{ $registerText }}</a>
            </p>
        @endif
    </div>
</div>