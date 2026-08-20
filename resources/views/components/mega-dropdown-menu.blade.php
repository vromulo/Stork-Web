@props(['categories'])

<div 
    x-show="activeMenu"

    class="absolute top-full left-0 right-0 mx-auto w-full max-w-7xl h-[450px] overflow-y-auto bg-surface border border-t-0 border-border-subtle z-50 rounded-b-2xl [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:bg-surface-subtle [&::-webkit-scrollbar-thumb]:bg-border-subtle [&::-webkit-scrollbar-thumb]:rounded-full"
    
    x-cloak
    style="display: none;"
>
    <!-- Top Accent Line (Sticky so it stays at the top when scrolling) -->
    <div class="h-1 w-full bg-primary/20 sticky top-0 z-10"></div>

    <div class="p-8 lg:p-10">
        @foreach($categories as $categoryName => $subcategories)
            @if(count($subcategories) > 0)
                <div x-show="activeMenu === '{{ addslashes($categoryName) }}'" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                    
                    <!-- The "View All" Button (Always First) -->
                    <a href="{{ url('/category/' . Str::slug($categoryName)) }}" class="flex flex-col items-center group text-center">
                        <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-border-subtle group-hover:border-primary transition-colors duration-300 shadow-sm relative bg-gray-100 dark:bg-gray-800 flex items-center justify-center shrink-0">
                            <!-- 3 Squares and 1 Circle Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-text-muted group-hover:text-primary group-hover:scale-110 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <rect x="4" y="4" width="6" height="6" rx="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <rect x="14" y="4" width="6" height="6" rx="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <rect x="4" y="14" width="6" height="6" rx="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="17" cy="17" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-text-main group-hover:text-primary transition-colors leading-snug">
                            View All
                        </span>
                    </a>

                    <!-- The Rest of the Subcategories -->
                    @foreach($subcategories as $sub)
                        <a href="#" class="flex flex-col items-center group text-center">
                            <!-- Circular Image -->
                            <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-border-subtle group-hover:border-primary transition-colors duration-300 shadow-sm relative bg-surface-subtle shrink-0">
                                <img 
                                    src="{{ $sub['image'] }}" 
                                    alt="{{ $sub['name'] }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                >
                            </div>
                            <!-- Subcategory Title -->
                            <span class="text-sm font-bold text-text-main group-hover:text-primary transition-colors leading-snug">
                                {{ $sub['name'] }}
                            </span>
                        </a>
                    @endforeach
                    
                </div>
            @endif
        @endforeach
    </div>
</div>