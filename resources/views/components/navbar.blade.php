<nav class="bg-surface sticky top-0 z-50 font-sans">
    <!-- Top notification bar: Hidden on mobile using 'hidden md:block' -->
    <div class="hidden md:block py-1.5 text-xs text-surface bg-primary-dark font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-brand-light hover:underline transition-colors">Start Selling</a>
                <span class="text-surface-subtle opacity-70">|</span>
                <a href="#" class="hover:text-brand-light hover:underline transition-colors">Join the Logistics Team</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-brand-light hover:underline transition-colors">Help</a>
                <span class="text-surface-subtle opacity-70">|</span>
                <a href="#" class="hover:text-brand-light hover:underline transition-colors">Contact</a>
            </div>
        </div>
    </div>

    <div class="relative z-30 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Responsive Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center">
                    <!-- Mobile view: Minimized logo -->
                    <img src="{{ asset('assets/storkia-minimized.png') }}" alt="Storkia" class="block md:hidden h-8 w-auto object-contain">
                    <!-- Desktop view: Maximized logo -->
                    <img src="{{ asset('assets/storkia-maximized.png') }}" alt="Storkia" class="hidden md:block h-10 w-auto object-contain">
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex flex-1 max-w-3xl mx-3 sm:mx-4 md:mx-8">
                <div class="relative w-full">
                    <input type="text" placeholder="Search products..." class="w-full bg-surface-subtle border border-border-subtle rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent text-text-main placeholder:text-text-muted text-sm sm:text-base">
                    <div class="absolute left-3 top-2.5 text-text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Action Icons: Spacing optimized for mobile using 'space-x-4 md:space-x-6' -->
            <div class="flex items-center space-x-4 md:space-x-6">
                
                <!-- Profile Menu -->
                <div x-data="{ open: false, timer: null }" 
                     @mouseenter="clearTimeout(timer); open = true" 
                     @mouseleave="timer = setTimeout(() => { open = false }, 300)" 
                     class="relative flex items-center h-full">
                    
                    <button type="button" class="flex items-center text-text-main hover:text-primary transition-colors cursor-pointer focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </button>
                    
                    <div x-show="open" x-cloak class="absolute right-0 top-full mt-2 w-48 bg-white border border-border-subtle rounded-xl shadow-xl z-50 overflow-hidden">
                        <div class="p-2 flex flex-col space-y-1">
                            @guest
                                <a href="{{ route('login') }}" class="block px-3 py-2 text-xs font-bold text-primary-dark rounded-lg hover:bg-surface-subtle hover:text-primary transition-colors">
                                    Sign in / Register
                                </a>
                            @endguest

                            @auth
                                <a href="#" class="block px-3 py-2 text-xs font-bold text-primary-dark rounded-lg hover:bg-surface-subtle hover:text-primary transition-colors">
                                    My account
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-3 py-2 text-xs font-bold text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            @endauth
                            
                            <hr class="border-border-subtle my-1 mx-2">
                            
                            <a href="#" class="block px-3 py-2 text-xs font-medium text-text-main rounded-lg hover:bg-surface-subtle hover:text-primary transition-colors">
                                My Orders
                            </a>
                            <a href="#" class="block px-3 py-2 text-xs font-medium text-text-main rounded-lg hover:bg-surface-subtle hover:text-primary transition-colors">
                                My Messages
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Cart -->
                <a href="#" class="relative flex items-center text-text-main hover:text-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-primary text-surface text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center" style="background-color: #d8457c; color: white;">3</span>
                </a>
            </div>
        </div>
    </div>
</nav>