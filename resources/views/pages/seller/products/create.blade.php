<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storkia - Add Product</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; } 
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 6px; } 
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; } 
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
        
        .no-spinners::-webkit-inner-spin-button,
        .no-spinners::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        .no-spinners { -moz-appearance: textfield; }
    </style>
    <script>
        function variantManager() {
            return {
                variantTitle: '',
                subVariantTitle: '',
                variants: [ { id: Date.now(), name: '', subs: [], imagePreview: null } ],
                isCopied: false, 
                
                get priceDependsOn() {
                    return this.subVariantTitle.trim() !== '' ? 'sub' : 'main';
                },

                get duplicateVariants() {
                    const names = this.variants.map(v => v.name.trim().toLowerCase()).filter(n => n !== '');
                    return names.filter((item, index) => names.indexOf(item) !== index);
                },

                isSubVariantDuplicate(variant, subName) {
                    if (!subName.trim()) return false;
                    const names = variant.subs.map(s => s.name.trim().toLowerCase());
                    const count = names.filter(n => n === subName.trim().toLowerCase()).length;
                    return count > 1;
                },

                get hasValidationErrors() {
                    if (this.duplicateVariants.length > 0) return true;
                    for (const v of this.variants) {
                        const subNames = v.subs.map(s => s.name.trim().toLowerCase()).filter(n => n !== '');
                        const hasDupes = subNames.filter((item, index) => subNames.indexOf(item) !== index).length > 0;
                        if (hasDupes) return true;
                    }
                    return false;
                },
                
                addMainVariant() {
                    this.variants.push({ id: Date.now(), name: '', subs: [], imagePreview: null });
                    this.isCopied = false; 
                },
                removeMainVariant(id) {
                    this.variants = this.variants.filter(v => v.id !== id);
                },
                addSubVariant(vId) {
                    const variant = this.variants.find(v => v.id === vId);
                    if (variant) variant.subs.push({ id: Date.now(), name: '', price: '', weight: '' });
                },
                removeSubVariant(vId, sId) {
                    const variant = this.variants.find(v => v.id === vId);
                    if (variant) variant.subs = variant.subs.filter(s => s.id !== sId);
                },
                
                handleVariantImage(event, vId) {
                    const file = event.target.files[0];
                    const variant = this.variants.find(v => v.id === vId);
                    if (file && variant) {
                        const reader = new FileReader();
                        reader.onload = (e) => variant.imagePreview = e.target.result;
                        reader.readAsDataURL(file);
                    } else if (variant) {
                        variant.imagePreview = null;
                    }
                },

                copySubVariants() {
                    if(this.variants.length <= 1) return;
                    
                    const firstVariantSubs = this.variants[0].subs;
                    if(firstVariantSubs.length === 0) {
                        alert("Please add at least one sub-variant to the first item before copying.");
                        return;
                    }

                    for(let i = 1; i < this.variants.length; i++) {
                        this.variants[i].subs = firstVariantSubs.map(s => ({
                            id: Date.now() + Math.random(),
                            name: s.name,
                            price: s.price,
                            weight: s.weight
                        }));
                    }

                    this.isCopied = true;
                }
            }
        }
    </script>
</head>
<body class="m-0 p-0 h-screen w-screen font-sans antialiased text-text-main overflow-hidden bg-gradient-to-b from-surface via-surface to-brand-light/30">
    
    <div x-data="{ sidebarOpen: localStorage.getItem('sellerSidebarOpen') !== 'false', imageModalOpen: false, imageModalSrc: '' }" class="h-screen w-full relative flex">
        
        @include('components.seller-components.seller-sidebar')

        <main class="flex-1 h-screen overflow-y-auto custom-scrollbar relative" x-data="{ showContent: false }" x-init="setTimeout(() => showContent = true, 50)">
            <div class="p-8 lg:p-12" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                
                <div class="max-w-4xl mx-auto">
                    <div class="flex items-center mb-8">
                        <a href="{{ route('seller.products.index') }}" class="mr-4 p-2 bg-white rounded-full shadow-sm border border-border-subtle hover:bg-brand-light/20 transition-colors text-text-muted hover:text-primary cursor-pointer">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <h1 class="text-3xl font-bold text-primary-dark">Add New Product</h1>
                    </div>

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                            <ul class="list-disc list-inside text-red-600 text-sm">
                                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Moved x-data="variantManager()" here to wrap the entire form and the submit button -->
                    <form x-data="variantManager()" action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-8 shadow-sm border border-border-subtle space-y-6">
                        @csrf
                        
                        <!-- Top Level Details -->
                        <div>
                            <label class="block text-sm font-bold text-text-muted mb-1">Product Name (Max 100 chars) <span class="text-red-500">*</span></label>
                            <input type="text" name="name" maxlength="100" required value="{{ old('name') }}" class="w-full p-3 rounded-xl border border-border-subtle focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-text-muted mb-1">Discount <span class="text-xs font-normal italic">(Optional)</span></label>
                                <div class="relative flex items-center">
                                    <input type="number" step="0.01" min="0" name="discount" value="{{ old('discount', 0) }}" 
                                           onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46"
                                           class="w-full pr-9 p-3 rounded-xl border border-border-subtle focus:border-primary outline-none no-spinners cursor-text">
                                    <span class="absolute right-4 text-text-muted font-bold">%</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-text-muted mb-1">Total Stock Quantity <span class="text-red-500">*</span></label>
                                <input type="number" min="0" name="stock_quantity" required value="{{ old('stock_quantity') }}" 
                                       onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                       class="w-full p-3 rounded-xl border border-border-subtle focus:border-primary outline-none no-spinners cursor-text">
                            </div>
                        </div>

                        <!-- Main Image Upload (Has nested x-data, which is perfectly valid in Alpine) -->
                        <div x-data="{
                                previews: [],
                                handleMainFiles(event) {
                                    this.previews = [];
                                    const files = event.target.files;
                                    for(let i = 0; i < files.length; i++) {
                                        let reader = new FileReader();
                                        reader.onload = (e) => this.previews.push(e.target.result);
                                        reader.readAsDataURL(files[i]);
                                    }
                                }
                            }">
                            <label class="block text-sm font-bold text-text-muted mb-1">Main Product Pictures <span class="text-red-500">*</span></label>
                            <input type="file" name="pictures[]" multiple accept="image/*" required @change="handleMainFiles" class="w-full p-3 rounded-xl border border-border-subtle bg-surface file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                            
                            <div x-show="previews.length > 0" x-cloak x-transition class="flex gap-3 overflow-x-auto mt-4 pb-2 custom-scrollbar">
                                <template x-for="preview in previews">
                                    <img :src="preview" @click="imageModalSrc = preview; imageModalOpen = true" class="w-24 h-24 object-cover rounded-xl border border-border-subtle shadow-sm flex-shrink-0 cursor-pointer hover:opacity-80 transition-opacity">
                                </template>
                            </div>
                        </div>

                        <!-- SHOPEE STYLE VARIANT SYSTEM -->
                        <div class="border border-border-subtle rounded-2xl p-6 bg-brand-light/10 space-y-6">
                            
                            <div class="border-b border-border-subtle pb-4">
                                <h3 class="text-lg font-bold text-primary-dark mb-4">Product Variants</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-text-muted mb-1">Title of the Variants <span class="text-red-500">*</span></label>
                                        <input type="text" name="variant_title" x-model="variantTitle" placeholder="e.g. Color, Units" required class="w-full p-2.5 rounded-lg border border-border-subtle focus:border-primary outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-text-muted mb-1">Sub-title (Optional)</label>
                                        <input type="text" name="sub_variant_title" x-model="subVariantTitle" placeholder="e.g. Size, RAM" class="w-full p-2.5 rounded-lg border border-border-subtle focus:border-primary outline-none">
                                    </div>
                                </div>
                            </div>

                            <!-- MAIN VARIANTS LOOP -->
                            <div class="space-y-4">
                                <template x-for="(v, vIndex) in variants" :key="v.id">
                                    <div class="bg-white rounded-xl border border-border-subtle shadow-sm overflow-hidden">
                                        
                                        <!-- Main Variant Row -->
                                        <div class="p-4 flex flex-col md:flex-row md:items-start gap-4 bg-surface/50 border-b border-border-subtle">
                                            
                                            <!-- Main Variant Name with Validation -->
                                            <div class="flex-1">
                                                <input type="text" :name="`variant_names[${v.id}]`" x-model="v.name" :placeholder="`${variantTitle || 'Variant'} Name (e.g. Red)`" required 
                                                       :class="duplicateVariants.includes(v.name.trim().toLowerCase()) && v.name.trim() !== '' ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-border-subtle focus:border-primary'"
                                                       class="w-full p-2 text-sm rounded-lg border outline-none transition-colors">
                                                <span x-show="duplicateVariants.includes(v.name.trim().toLowerCase()) && v.name.trim() !== ''" class="text-red-500 text-[10px] font-bold mt-1 block">Variant name must be unique.</span>
                                            </div>
                                            
                                            <!-- Image Upload & Preview -->
                                            <div class="flex-1 flex items-center gap-3">
                                                <template x-if="v.imagePreview">
                                                    <img :src="v.imagePreview" @click="imageModalSrc = v.imagePreview; imageModalOpen = true" class="w-10 h-10 object-cover rounded-lg border border-border-subtle shadow-sm flex-shrink-0 cursor-pointer hover:opacity-80 transition-opacity">
                                                </template>
                                                <input type="file" :name="`variant_pictures[${v.id}]`" accept="image/*" required @change="handleVariantImage($event, v.id)" class="w-full text-sm text-text-muted file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:bg-primary/10 file:text-primary cursor-pointer">
                                            </div>

                                            <template x-if="priceDependsOn === 'main'">
                                                <div class="flex gap-2 w-full md:w-auto">
                                                    <div class="relative w-full md:w-32">
                                                        <span class="absolute left-2.5 top-2 text-text-muted text-xs font-bold">₱</span>
                                                        <input type="number" step="0.01" min="20" :name="`variant_prices[${v.id}]`" placeholder="Price" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" class="w-full pl-6 p-2 text-sm rounded-lg border border-border-subtle focus:border-primary outline-none no-spinners cursor-text">
                                                    </div>
                                                    <div class="relative w-full md:w-28">
                                                        <input type="number" step="0.01" min="0" :name="`variant_weights[${v.id}]`" placeholder="Weight" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" class="w-full pr-8 p-2 text-sm rounded-lg border border-border-subtle focus:border-primary outline-none no-spinners cursor-text">
                                                        <span class="absolute right-2.5 top-2 text-text-muted text-xs font-bold">KG</span>
                                                    </div>
                                                </div>
                                            </template>

                                            <button type="button" @click="removeMainVariant(v.id)" class="text-red-500 hover:text-red-700 p-2 mt-1 md:mt-0 cursor-pointer">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </div>

                                        <!-- Sub Variants -->
                                        <div x-show="priceDependsOn === 'sub'" class="p-4 bg-white space-y-3">
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="text-xs font-bold text-text-muted uppercase tracking-wider" x-text="subVariantTitle"></span>
                                                <button type="button" @click="addSubVariant(v.id)" class="text-xs font-bold text-primary hover:text-primary-dark cursor-pointer">+ Add <span x-text="subVariantTitle"></span></button>
                                            </div>

                                            <template x-for="(sub, sIndex) in v.subs" :key="sub.id">
                                                <div class="flex items-start gap-3 bg-brand-light/10 p-2.5 rounded-lg border border-brand-light/30">
                                                    
                                                    <div class="flex-1">
                                                        <input type="text" :name="`sub_variant_names[${v.id}][${sub.id}]`" x-model="sub.name" :placeholder="`${subVariantTitle} Name (e.g. 128GB)`" required 
                                                               :class="isSubVariantDuplicate(v, sub.name) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-border-subtle focus:border-primary'"
                                                               class="w-full p-2 text-xs rounded-md border outline-none transition-colors">
                                                        <span x-show="isSubVariantDuplicate(v, sub.name)" class="text-red-500 text-[10px] font-bold mt-1 block">Sub-variant must be unique.</span>
                                                    </div>
                                                    
                                                    <div class="flex gap-2">
                                                        <div class="relative w-28">
                                                            <span class="absolute left-2.5 top-1.5 text-text-muted text-xs font-bold">₱</span>
                                                            <input type="number" step="0.01" min="20" :name="`sub_variant_prices[${v.id}][${sub.id}]`" x-model="sub.price" placeholder="Price" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" class="w-full pl-6 p-2 text-xs rounded-md border border-border-subtle focus:border-primary outline-none no-spinners cursor-text">
                                                        </div>
                                                        <div class="relative w-24">
                                                            <input type="number" step="0.01" min="0" :name="`sub_variant_weights[${v.id}][${sub.id}]`" x-model="sub.weight" placeholder="Weight" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" class="w-full pr-7 p-2 text-xs rounded-md border border-border-subtle focus:border-primary outline-none no-spinners cursor-text">
                                                            <span class="absolute right-2 top-1.5 text-text-muted text-xs font-bold">KG</span>
                                                        </div>
                                                    </div>

                                                    <button type="button" @click="removeSubVariant(v.id, sub.id)" class="text-text-muted hover:text-red-500 mt-1 cursor-pointer">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                    </button>
                                                </div>
                                            </template>
                                            
                                            <!-- Smart Copier inside variant loop -->
                                            <div x-show="v.subs.length === 0" class="space-y-4 mt-2">
                                                <div x-show="vIndex !== 0 && variants[0].subs.length > 0 && !isCopied" x-transition class="p-4 bg-blue-50 border border-blue-200 rounded-xl flex flex-col sm:flex-row items-center justify-between shadow-sm">
                                                    <div class="flex items-center text-blue-700 text-sm mb-3 sm:mb-0">
                                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 8h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                        <span>Save time! Do all variants share the same sub-variants?</span>
                                                    </div>
                                                    <button type="button" @click="copySubVariants" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg shadow-sm hover:bg-blue-700 transition-colors cursor-pointer">
                                                        Copy from 1st Variant
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </template>
                                
                                <button type="button" @click="addMainVariant()" class="w-full py-3 border-2 border-dashed border-primary/50 text-primary font-bold rounded-xl hover:bg-primary/5 transition-colors cursor-pointer">
                                    + Add <span x-text="variantTitle || 'Variant'"></span>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-text-muted mb-1">Standard Description</label>
                            <textarea name="description" rows="3" class="w-full p-3 rounded-xl border border-border-subtle focus:border-primary outline-none custom-scrollbar cursor-text">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-text-muted mb-1">Additional Descriptions <span class="text-xs font-normal italic">(Optional)</span></label>
                            <textarea name="additional_descriptions" rows="3" class="w-full p-3 rounded-xl border border-border-subtle focus:border-primary outline-none custom-scrollbar cursor-text">{{ old('additional_descriptions') }}</textarea>
                        </div>

                        <!-- Fixed Validated Button -->
                        <div class="flex justify-end mt-8 border-t border-border-subtle pt-6">
                            <button type="submit" 
                                    :disabled="hasValidationErrors" 
                                    :class="hasValidationErrors ? 'opacity-50 cursor-not-allowed bg-gray-400' : 'bg-primary hover:bg-primary-dark cursor-pointer'"
                                    class="px-8 py-3 text-white rounded-xl shadow-md transition-all font-bold text-lg">
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <template x-teleport="body">
            <div x-show="imageModalOpen" x-cloak x-transition class="fixed inset-0 z-[200] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 cursor-default">
                
                <div @click.away="imageModalOpen = false" class="relative max-w-5xl max-h-[90vh] flex flex-col items-center justify-center cursor-default">
                    
                    <button @click="imageModalOpen = false" class="absolute -top-12 right-0 md:-right-12 p-2 text-white/70 hover:text-white hover:bg-white/10 rounded-full transition-all cursor-pointer">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    
                    <img :src="imageModalSrc" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
                    
                </div>
            </div>
        </template>
        
    </div>
</body>
</html>