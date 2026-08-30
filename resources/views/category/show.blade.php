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

    <!-- Main Wrapper with dynamic selectedSubcategory initial state -->
    <div x-data="{ selectedSubcategory: '{{ addslashes($selectedSubcategory ?? 'All') }}', modalOpen: false, activeProduct: null }"
         @filter-category.window="selectedSubcategory = $event.detail"
         class="bg-surface font-sans antialiased text-text-main overflow-x-hidden min-h-screen">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in-up">
            
            <!-- Category Hero Banner -->
            <div class="relative bg-gradient-to-r from-brand-light/60 to-surface-subtle rounded-3xl overflow-hidden mb-8 shadow-sm border border-border-subtle h-[280px] flex items-center">
                <div class="absolute -right-20 -top-20 w-[500px] h-[500px] bg-secondary opacity-10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10 p-10 md:p-16 w-full">
                    <h1 class="text-4xl md:text-5xl font-serif text-primary-dark font-bold leading-tight mb-4">
                        {{ $categoryName }}
                    </h1>
                    <p class="text-text-muted mb-8 text-lg">Shop the latest and greatest in {{ strtolower($categoryName) }}.</p>
                </div>
            </div>

            <!-- Subcategory Interactive Grid -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Shop by Subcategory</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                    
                    <!-- View All Subcategory Option -->
                    <button @click="selectedSubcategory = 'All'" class="flex flex-col items-center group text-center focus:outline-none">
                        <div :class="selectedSubcategory === 'All' ? 'border-primary bg-primary/10' : 'border-border-subtle bg-gray-100 dark:bg-gray-800'" 
                             class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 group-hover:border-primary transition-colors duration-300 shadow-sm relative flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" :class="selectedSubcategory === 'All' ? 'text-primary' : 'text-text-muted'" class="w-8 h-8 group-hover:text-primary group-hover:scale-110 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <rect x="4" y="4" width="6" height="6" rx="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <rect x="14" y="4" width="6" height="6" rx="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <rect x="4" y="14" width="6" height="6" rx="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="17" cy="17" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span :class="selectedSubcategory === 'All' ? 'text-primary' : 'text-text-main'" class="text-sm font-bold group-hover:text-primary transition-colors leading-snug">
                            View All
                        </span>
                    </button>

                    <!-- Render Subcategories with highlight state -->
                    @foreach($subcategories as $sub)
                        <button @click="selectedSubcategory = '{{ addslashes($sub['name']) }}'" class="flex flex-col items-center group text-center focus:outline-none">
                            <div :class="selectedSubcategory === '{{ addslashes($sub['name']) }}' ? 'border-primary' : 'border-border-subtle'" 
                                 class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 group-hover:border-primary transition-colors duration-300 shadow-sm relative bg-surface-subtle shrink-0">
                                <img src="{{ $sub['image'] }}" alt="{{ $sub['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <span :class="selectedSubcategory === '{{ addslashes($sub['name']) }}' ? 'text-primary' : 'text-text-main'" class="text-sm font-bold group-hover:text-primary transition-colors leading-snug">
                                {{ $sub['name'] }}
                            </span>
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