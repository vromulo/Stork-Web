<div x-data="{ 
        activeSlide: 1, 
        timer: null,
        startTimer() {
            this.timer = setInterval(() => { 
                this.activeSlide = this.activeSlide === 3 ? 1 : this.activeSlide + 1; 
            }, 5000);
        },
        resetTimer(slide) {
            clearInterval(this.timer);
            this.activeSlide = slide;
            this.startTimer();
        }
     }"
     x-init="startTimer()"
     class="relative w-1/2 h-full bg-primary-dark flex flex-col items-center justify-center overflow-hidden shrink-0">
    
    <!-- Rich Pink Gradient Overlay -->
    <div class="absolute inset-0 bg-primary opacity-90"></div>
    
    <!-- Subtle background accents -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-secondary rounded-full filter blur-[100px] opacity-40 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-brand-light rounded-full filter blur-[100px] opacity-20 pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-lg px-12 text-center flex flex-col items-center">
        
        <!-- Grid container for pure crossfading -->
        <div class="grid grid-cols-1 grid-rows-1 place-items-center w-full min-h-[300px]">
            
            <!-- Slide 1 -->
            <div x-show="activeSlide === 1" 
                 x-transition:enter="transition ease-in-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in-out duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="col-start-1 row-start-1 flex flex-col items-center w-full">
                <div class="w-24 h-24 mb-8 text-brand-light flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h2 class="text-4xl font-serif mb-4 text-surface drop-shadow-md">Lightning Fast Delivery</h2>
                <p class="text-surface font-sans text-lg opacity-90 leading-relaxed">Experience the fastest routing in the city. Your package arrives before you know it.</p>
            </div>

            <!-- Slide 2 -->
            <div x-show="activeSlide === 2" 
                 x-transition:enter="transition ease-in-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in-out duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="col-start-1 row-start-1 flex flex-col items-center w-full" style="display: none;">
                <div class="w-24 h-24 mb-8 text-brand-light flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h2 class="text-4xl font-serif mb-4 text-surface drop-shadow-md">Secure Handling</h2>
                <p class="text-surface font-sans text-lg opacity-90 leading-relaxed">Every item is tracked and handled with the utmost care by our verified couriers.</p>
            </div>

            <!-- Slide 3 -->
            <div x-show="activeSlide === 3" 
                 x-transition:enter="transition ease-in-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in-out duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="col-start-1 row-start-1 flex flex-col items-center w-full" style="display: none;">
                <div class="w-24 h-24 mb-8 text-brand-light flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h2 class="text-4xl font-serif mb-4 text-surface drop-shadow-md">Real-time Tracking</h2>
                <p class="text-surface font-sans text-lg opacity-90 leading-relaxed">Watch your delivery move across the map in real-time, right to your doorstep.</p>
            </div>
        </div>

        <!-- Manual Navigation Dots (Resets Timer) -->
        <div class="flex justify-center space-x-4 mt-8 w-full relative z-20">
            <button @click="resetTimer(1)" :class="{'bg-brand-light w-10': activeSlide === 1, 'bg-surface opacity-40 w-3 hover:opacity-70': activeSlide !== 1}" class="h-3 rounded-full transition-all duration-300"></button>
            <button @click="resetTimer(2)" :class="{'bg-brand-light w-10': activeSlide === 2, 'bg-surface opacity-40 w-3 hover:opacity-70': activeSlide !== 2}" class="h-3 rounded-full transition-all duration-300"></button>
            <button @click="resetTimer(3)" :class="{'bg-brand-light w-10': activeSlide === 3, 'bg-surface opacity-40 w-3 hover:opacity-70': activeSlide !== 3}" class="h-3 rounded-full transition-all duration-300"></button>
        </div>
    </div>
</div>