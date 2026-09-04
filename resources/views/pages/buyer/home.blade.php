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

    <div x-data="{ modalOpen: false, activeProduct: null }" class="bg-surface font-sans antialiased text-text-main overflow-x-hidden min-h-screen">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in-up">
            
            <!-- Hero Banner -->
            <div class="relative bg-gradient-to-r from-brand-light/60 to-surface-subtle rounded-3xl overflow-hidden mb-12 shadow-sm border border-border-subtle h-[350px] flex items-center">
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

            <!-- Products Grid Component -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse($products as $product)
                    <x-seller-product-card :product="$product" />
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        No products available at the moment.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection 