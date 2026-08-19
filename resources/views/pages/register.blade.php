<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stork - Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Modern Rounded Scrollbar for form overflows and dropdowns */
        .rounded-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .rounded-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .rounded-scrollbar::-webkit-scrollbar-thumb {
            background-color: var(--color-primary, #CF4173);
            border-radius: 9999px;
        }
        .rounded-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: var(--color-primary-dark, #5D3140);
        }
    </style>
</head>
<body class="m-0 p-0 h-screen w-screen flex font-sans antialiased text-text-main overflow-hidden bg-surface">
    
    <!-- Left Side: Carousel -->
    <x-carousel />

    <!-- Right Side: Register Form (Scrollable Area) -->
    <div class="w-1/2 h-full flex flex-col items-center justify-start p-8 lg:p-12 bg-gradient-to-br from-surface-subtle via-surface to-brand-light/30 overflow-y-auto rounded-scrollbar">
        <div class="w-full max-w-2xl bg-surface/90 backdrop-blur-sm p-8 rounded-[2rem] shadow-xl border border-border-subtle my-auto">
            
            <div class="text-center mb-8">
                <a href="/" class="text-4xl font-serif text-primary-dark tracking-tight hover:text-primary transition-colors inline-block mb-1">Stork</a>
                <h1 class="text-2xl font-bold text-text-main">Create your Profile</h1>
                <p class="text-text-muted mt-1 text-sm">Please fill in the details below to join us.</p>
            </div>

            <!-- Form wrapped in Alpine component to handle Age Autogen -->
            <form action="#" method="POST" 
                  x-data="{
                      birthday: '',
                      get age() {
                          if (!this.birthday) return '';
                          const today = new Date();
                          const birthDate = new Date(this.birthday);
                          let calculatedAge = today.getFullYear() - birthDate.getFullYear();
                          const m = today.getMonth() - birthDate.getMonth();
                          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                              calculatedAge--;
                          }
                          return calculatedAge;
                      }
                  }" 
                  class="grid grid-cols-1 md:grid-cols-12 gap-5">
                
                <!-- NAME ROW -->
                <div class="md:col-span-5">
                    <label class="block text-xs font-bold text-text-main mb-1">Last Name*</label>
                    <input type="text" required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="Doe">
                </div>
                <div class="md:col-span-5">
                    <label class="block text-xs font-bold text-text-main mb-1">First Name*</label>
                    <input type="text" required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="John">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-text-main mb-1">M.I.</label>
                    <input type="text" maxlength="2" class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm text-center" placeholder="A.">
                </div>

                <!-- SEX & CONTACT ROW -->
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-text-main mb-1">Sex*</label>
                    <select required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm appearance-none rounded-scrollbar cursor-pointer">
                        <option value="" disabled selected>Select...</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="md:col-span-8">
                    <label class="block text-xs font-bold text-text-main mb-1">Contact No.*</label>
                    <input type="tel" required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="+63 9XX XXX XXXX">
                </div>

                <!-- EMAIL ROW -->
                <div class="md:col-span-12">
                    <label class="block text-xs font-bold text-text-main mb-1">E-mail*</label>
                    <input type="email" required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="you@example.com">
                </div>

                <!-- BIRTHDAY & AGE ROW -->
                <div class="md:col-span-8">
                    <label class="block text-xs font-bold text-text-main mb-1">Birthday*</label>
                    <input type="date" x-model="birthday" required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm cursor-pointer text-text-muted">
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-text-main mb-1">Age</label>
                    <input type="number" :value="age" readonly class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface-subtle text-text-muted font-bold outline-none shadow-sm text-sm cursor-not-allowed" placeholder="Auto">
                </div>

                <!-- ADDRESS DROPDOWNS ROW (API Prepared) -->
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-text-main mb-1">Province*</label>
                    <select required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm appearance-none rounded-scrollbar cursor-pointer">
                        <option value="" disabled selected>Select Province</option>
                        <!-- API Options will map here -->
                    </select>
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-text-main mb-1">Municipality*</label>
                    <select required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm appearance-none rounded-scrollbar cursor-pointer">
                        <option value="" disabled selected>Select Municipality</option>
                        <!-- API Options will map here -->
                    </select>
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-text-main mb-1">Barangay*</label>
                    <select required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm appearance-none rounded-scrollbar cursor-pointer">
                        <option value="" disabled selected>Select Barangay</option>
                        <!-- API Options will map here -->
                    </select>
                </div>

                <!-- MANUAL ADDRESS ROW -->
                <div class="md:col-span-12">
                    <label class="block text-xs font-bold text-text-main mb-1">Street, House No., Subd.*</label>
                    <input type="text" required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="123 Main St., Blk 4 Lot 2">
                </div>

                <!-- FILE UPLOAD ROW -->
                <div class="md:col-span-12">
                    <label class="block text-xs font-bold text-text-main mb-1">Upload Valid ID*</label>
                    <div class="w-full flex items-center justify-center px-4 py-4 border-2 border-dashed border-border-subtle rounded-xl bg-surface-subtle hover:bg-surface hover:border-primary transition-colors group cursor-pointer relative overflow-hidden">
                        <input type="file" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*,.pdf">
                        <div class="text-center flex flex-col items-center">
                            <svg class="mx-auto h-6 w-6 text-text-muted group-hover:text-primary transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span class="mt-1 text-xs text-text-muted group-hover:text-text-main font-medium">Click to browse or drag file here</span>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT BUTTON -->
                <div class="md:col-span-12 mt-2">
                    <button type="submit" class="w-full py-3 px-4 bg-primary hover:bg-primary-dark text-surface text-base font-bold rounded-xl shadow-md transition-colors transform active:scale-[0.98]">
                        Complete Registration
                    </button>
                    <p class="mt-4 text-center text-xs text-text-muted">
                        Already have an account? 
                        <a href="/login" class="font-bold text-primary hover:text-primary-dark transition-colors">Sign in here</a>
                    </p>
                </div>
            </form>

        </div>
    </div>
</body>
</html>