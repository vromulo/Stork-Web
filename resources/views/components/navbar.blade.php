<nav class="bg-surface border-b border-border-subtle sticky top-0 z-50 font-sans">
    
    <!-- Top Bar -->
    <div class="py-1.5 text-xs text-white" style="background-color: #432630;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <!-- Left Options -->
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:underline">Become a Seller</a>
                <span class="opacity-70">|</span>
                <a href="#" class="hover:underline">Become a Courier</a>
            </div>
            <!-- Right Options -->
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:underline">Help</a>
                <span class="opacity-70">|</span>
                <a href="#" class="hover:underline">Contact</a>
            </div>
        </div>
    </div>

    <!-- Main Navbar Content (Layer 2) -->
    <div class="relative z-30 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-3xl font-serif text-primary-dark tracking-tight hover:text-primary transition-colors">
                    Stork
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex flex-1 max-w-3xl mx-4 md:mx-8">
                <div class="relative w-full">
                    <input type="text" placeholder="Search products..." 
                        class="w-full bg-surface-subtle border border-border-subtle rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent text-text-main placeholder:text-text-muted">
                    <div class="absolute left-3 top-2.5 text-text-muted">
                        <!-- Search Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Icons (Cart & Account) -->
            <div class="flex items-center space-x-4">
                
                <!-- Account Icon with Clickable Dropdown -->
                <!-- Removed h-full here so the relative wrapper tightly hugs the button -->
                <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                    
                    <!-- Added cursor-pointer -->
                    <button @click="open = !open" type="button" 
                        class="cursor-pointer p-2 rounded-full text-text-main hover:bg-surface-subtle hover:text-primary transition-all focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="transform opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="transform opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="transform opacity-0 translate-y-2 scale-95"
                         class="absolute right-0 top-full mt-2 w-48 bg-white border border-border-subtle rounded-xl shadow-xl z-50 overflow-hidden"
                         style="display: none;"
                         x-cloak>
                         
                        <!-- Top Accent Line -->
                        <div class="h-1 w-full bg-primary"></div>
                        
                        <!-- Dropdown Links -->
                        <div class="p-2 flex flex-col space-y-1">
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-text-main rounded-lg hover:bg-surface-subtle hover:text-primary transition-colors group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-text-muted group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Login
                            </a>
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-text-main rounded-lg hover:bg-surface-subtle hover:text-primary transition-colors group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-text-muted group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Register
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Cart Icon with Badge -->
                <a href="#" class="text-text-main hover:text-primary transition-colors relative ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <!-- Cart Badge -->
                    <span class="absolute -top-2 -right-2 bg-primary text-surface text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        3
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Category Filter -->
    <x-category-filter />
    
</nav>