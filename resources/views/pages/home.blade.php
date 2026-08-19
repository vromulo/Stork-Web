<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stork - Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>
<body class="bg-surface font-sans antialiased text-text-main overflow-x-hidden" 
      x-data="{ selectedCategory: 'All', modalOpen: false, activeProduct: null }" 
      @filter-category.window="selectedCategory = $event.detail">
    
    <x-navbar />

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in-up">
        
        <div class="relative bg-gradient-to-r from-brand-light/60 to-surface-subtle rounded-3xl overflow-hidden mb-8 shadow-sm border border-border-subtle h-[350px] flex items-center">
            <div class="absolute -right-20 -top-20 w-[500px] h-[500px] bg-secondary opacity-10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 p-10 md:p-16 w-full md:w-2/3">
                <h1 class="text-4xl md:text-6xl font-serif text-primary-dark font-bold leading-tight mb-4">
                    Grab Up to 50% Off On <br class="hidden md:block">Selected Items
                </h1>
                <p class="text-text-muted mb-8 text-lg">Fast delivery. Exclusive deals. Right to your doorstep.</p>
                <a href="#" class="inline-flex px-8 py-3 bg-primary-dark hover:bg-primary text-surface font-bold rounded-full transition-colors duration-300 shadow-md relative z-30">
                    Shop Now
                </a>
            </div>
        </div>

        <div class="sticky top-16 z-40 bg-surface/95 backdrop-blur-sm pt-2 -mx-4 px-4 sm:mx-0 sm:px-0 relative z-30">
            <x-category-filter />
        </div>

        <div class="mt-8 mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold font-serif text-text-main transition-all duration-300">
                <span x-text="selectedCategory === 'All' ? 'Curated For You!' : selectedCategory + ' For You!'"></span>
            </h2>
            
            <button class="hidden sm:flex items-center space-x-2 border border-border-subtle rounded-full px-4 py-1.5 text-sm font-medium text-text-main hover:bg-surface-subtle transition-colors relative z-30">
                <span>Sort by</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pb-12 relative">
            @foreach($products as $index => $product)
                <div x-show="selectedCategory === 'All' || selectedCategory === '{{ addslashes($product['category']) }}'"
                     x-transition:enter="transition ease-out duration-500"
                     class="group flex flex-col relative"
                     x-cloak>
                    
                    <!-- Click Overlay for Auth / Guest Handling -->
                    @guest
                        <a href="{{ route('login') }}" class="absolute inset-0 z-20 cursor-pointer rounded-2xl"></a>
                    @endguest
                    @auth
                        <div @click="activeProduct = {{ json_encode($product) }}; modalOpen = true" class="absolute inset-0 z-20 cursor-pointer rounded-2xl"></div>
                    @endauth

                    <div class="relative bg-surface-subtle rounded-2xl aspect-[4/3] flex items-center justify-center p-6 mb-4 overflow-hidden border border-border-subtle group-hover:shadow-md transition-shadow duration-300">
                        <!-- Add relative z-30 to specific buttons so they aren't blocked by the click overlay -->
                        <button class="absolute top-3 right-3 bg-surface p-2 rounded-full shadow-sm text-text-muted hover:text-primary transition-colors z-30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                        
                        <div class="w-full h-full flex items-center justify-center text-border-subtle group-hover:scale-105 transition-transform duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-1 gap-2">
                            <h3 class="font-bold text-text-main line-clamp-1 flex-grow">{{ $product['name'] }}</h3>
                            <span class="font-bold text-text-main shrink-0">${{ number_format($product['price'], 2) }}</span>
                        </div>
                        <p class="text-sm text-text-muted mb-3 line-clamp-1">{{ $product['desc'] }}</p>
                        
                        <div class="flex items-center space-x-1 mb-4 mt-auto">
                            <div class="flex text-success">
                                @for($i = 0; $i < $product['rating']; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-text-muted">({{ $product['reviews'] }})</span>
                        </div>

                        <button class="w-full py-2 px-4 border-2 border-text-main rounded-full text-sm font-bold text-text-main hover:bg-primary-dark hover:border-primary-dark hover:text-surface transition-all duration-200 active:scale-[0.98] relative z-30">
                            Add to Cart
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Alpine Modal Overlay -->
    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <!-- Background Overlay -->
            <div x-show="modalOpen" @click="modalOpen = false" x-transition.opacity class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-50 backdrop-blur-sm" aria-hidden="true"></div>

            <!-- Modal Panel -->
            <div x-show="modalOpen" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="relative inline-block w-full max-w-xl p-8 overflow-hidden text-left align-middle transition-all transform bg-surface shadow-2xl rounded-2xl">
                
                <button @click="modalOpen = false" class="absolute top-4 right-4 text-text-muted hover:text-primary transition-colors focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="mt-4" x-if="activeProduct">
                    <h3 class="text-2xl font-bold font-serif text-primary-dark mb-2" x-text="activeProduct.name"></h3>
                    <div class="inline-block px-3 py-1 mb-4 text-xs font-medium bg-surface-subtle border border-border-subtle rounded-full text-text-muted" x-text="activeProduct.category"></div>
                    
                    <p class="text-text-main mb-6 leading-relaxed" x-text="activeProduct.desc"></p>
                    
                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-border-subtle">
                        <span class="text-3xl font-bold text-text-main">$<span x-text="activeProduct.price"></span></span>
                        <button class="px-6 py-3 text-sm font-bold text-surface bg-primary rounded-full hover:bg-primary-dark transition-colors shadow-md">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>