@php
$categories = [
    'All', 'Pet', 'Kids & Baby', 'Electronics', 'Home & Garden', 
    'Men\'s', 'Women\'s', 'Sports', 'Health & Beauty', 'Books & Media', 
    'Food & Grocery', 'Furniture & Office', 'Jewelry & Watches'
];
@endphp

<!-- Layer 1 -->
<div 
    x-data="{ 
        activeCategory: 'All',
        showLeft: false,
        showRight: true,
        init() {
            this.updateArrows();
            window.addEventListener('resize', () => this.updateArrows());
        },
        updateArrows() {
            const el = this.$refs.slider;
            this.showLeft = el.scrollLeft > 0;
            this.showRight = Math.ceil(el.scrollLeft + el.clientWidth) < el.scrollWidth - 1;
        },
        scroll(direction) {
            const el = this.$refs.slider;
            const scrollAmount = el.clientWidth * 0.8; 
            el.scrollBy({ 
                left: direction === 'left' ? -scrollAmount : scrollAmount, 
                behavior: 'smooth' 
            });
        }
    }" 
    class="w-full bg-surface border-b border-border-subtle py-2 relative z-10"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Inner wrapper to contain absolute positioned fades and arrows securely -->
        <div class="relative w-full">
            
            <!-- Left Gradient Fade -->
            <div 
                x-show="showLeft"
                x-transition.opacity.duration.300ms
                class="absolute left-0 top-0 bottom-0 w-16 md:w-12 bg-gradient-to-r from-surface to-transparent z-10 pointer-events-none"
                x-cloak
            ></div>

            <!-- Left Navigation Arrow -->
            <button 
                x-show="showLeft" 
                x-transition.opacity
                @click="scroll('left')" 
                class="absolute left-0 md:-left-2 top-1/2 -translate-y-1/2 z-20 bg-surface/90 shadow-sm backdrop-blur-sm rounded-full p-1.5 border border-border-subtle text-text-main hover:text-primary hover:border-primary transition-colors flex items-center justify-center cursor-pointer"
                aria-label="Previous categories"
                x-cloak
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Categories Container -->
            <div 
                x-ref="slider" 
                @scroll.passive="updateArrows"
                class="flex overflow-x-auto gap-2 pb-1 pt-1 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] relative z-0 px-2"
            >
                @foreach($categories as $category)
                    <button 
                        @click="activeCategory = '{{ addslashes($category) }}'"
                        :class="activeCategory === '{{ addslashes($category) }}' 
                            ? 'bg-primary text-surface shadow-sm' 
                            : 'bg-surface-subtle text-text-main hover:bg-border-subtle hover:text-primary-dark'"
                        class="flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-colors duration-200 whitespace-nowrap"
                    >
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            <!-- Right Gradient Fade -->
            <div 
                x-show="showRight"
                x-transition.opacity.duration.300ms
                class="absolute right-0 top-0 bottom-0 w-16 md:w-12 bg-gradient-to-l from-surface to-transparent z-10 pointer-events-none"
                x-cloak
            ></div>

            <!-- Right Navigation Arrow -->
            <button 
                x-show="showRight" 
                x-transition.opacity
                @click="scroll('right')" 
                class="absolute right-0 md:-right-2 top-1/2 -translate-y-1/2 z-20 bg-surface/90 shadow-sm backdrop-blur-sm rounded-full p-1.5 border border-border-subtle text-text-main hover:text-primary hover:border-primary transition-colors flex items-center justify-center cursor-pointer"
                aria-label="Next categories"
                x-cloak
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            
        </div>
    </div>
</div>