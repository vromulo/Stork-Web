<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stork - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="m-0 p-0 h-screen w-screen flex font-sans antialiased text-text-main overflow-hidden">
    
    <!-- Left Side: Carousel -->
    <x-carousel />

    <!-- Right Side: Login Form with Soft Gradient Background -->
    <div class="w-1/2 h-full flex flex-col items-center justify-center p-8 lg:p-12 bg-gradient-to-br from-surface-subtle via-surface to-brand-light/30">
        <div class="w-full max-w-md bg-surface/90 backdrop-blur-sm p-10 rounded-[2rem] shadow-xl border border-border-subtle">
            
            <div class="text-center mb-8">
                <a href="/" class="text-5xl font-serif text-primary-dark tracking-tight hover:text-primary transition-colors inline-block mb-2">Stork</a>
                <h1 class="text-2xl font-bold text-text-main">Welcome Back</h1>
                <p class="text-text-muted mt-1 text-sm">Please sign in to your account</p>
            </div>

            <form action="#" method="POST" class="space-y-5">
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-text-main mb-1">Email Address</label>
                    <div class="flex items-center w-full border-2 border-border-subtle rounded-xl bg-surface focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all overflow-hidden shadow-sm">
                        <div class="pl-4 pr-2 py-3 flex items-center justify-center text-primary">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" id="email" class="w-full py-3 pr-4 bg-transparent outline-none text-text-main" placeholder="you@example.com" required>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-text-main mb-1">Password</label>
                    <div class="flex items-center w-full border-2 border-border-subtle rounded-xl bg-surface focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all overflow-hidden shadow-sm">
                        <div class="pl-4 pr-2 py-3 flex items-center justify-center text-primary">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" class="w-full py-3 pr-4 bg-transparent outline-none text-text-main" placeholder="••••••••" required>
                    </div>
                    <div class="flex justify-end mt-2">
                        <a href="#" class="text-xs text-primary hover:text-primary-dark font-bold transition-colors">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 mt-6 bg-primary hover:bg-primary-dark text-surface text-lg font-bold rounded-xl shadow-md transition-colors">
                    Sign In
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-text-muted">
                Don't have an account? 
                <a href="/register" class="font-bold text-primary hover:text-primary-dark transition-colors">Create one</a>
            </p>
        </div>
    </div>
</body>
</html>