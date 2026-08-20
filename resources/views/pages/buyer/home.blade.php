@extends('layouts.app')

@section('content')

    <!-- Alpine.js & Custom Styles -->
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

    <!-- Main Wrapper (Controls Alpine state for child components) -->
    <div x-data="{ selectedCategory: 'Women', modalOpen: false, activeProduct: null }"
         @filter-category.window="selectedCategory = $event.detail"
         class="bg-surface font-sans antialiased text-text-main overflow-x-hidden min-h-screen">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in-up">
            
            <!-- Hero Banner -->
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

            <!-- Home-Specific Category Filter -->
            <div class="mt-4 mb-4 w-full overflow-x-auto pb-2 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                <div class="flex items-center justify-center space-x-8 md:space-x-12 px-4 md:px-0">
                    @php
                        $homeCategories = ['Women', 'Men', 'Kids', 'Home & Garden', 'Health & Beauty'];
                    @endphp
                    
                    @foreach($homeCategories as $category)
                        <button 
                            @click="selectedCategory = '{{ addslashes($category) }}'"
                            :class="selectedCategory === '{{ addslashes($category) }}' 
                                ? 'text-primary font-medium underline underline-offset-8 decoration-2' 
                                : 'text-text-muted font-extralight hover:text-primary transition-colors'"
                            class="flex-shrink-0 text-lg md:text-xl transition-all duration-200 whitespace-nowrap focus:outline-none">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Products Component -->
            <x-product-card :products="$products" />

        </div>

        <!-- Modal Component -->
        <x-product-modal />

    </div>

@endsection