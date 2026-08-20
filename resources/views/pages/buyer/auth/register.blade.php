<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stork - Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .rounded-scrollbar::-webkit-scrollbar { width: 6px; }
        .rounded-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .rounded-scrollbar::-webkit-scrollbar-thumb { background-color: var(--color-primary, #CF4173); border-radius: 9999px; }
        .rounded-scrollbar::-webkit-scrollbar-thumb:hover { background-color: var(--color-primary-dark, #5D3140); }
    </style>
</head>
<body class="m-0 p-0 h-screen w-screen flex font-sans antialiased text-text-main overflow-hidden bg-surface">
    
    <x-carousel />

    <div class="w-1/2 h-full flex flex-col items-center justify-start p-8 lg:p-12 bg-gradient-to-br from-surface-subtle via-surface to-brand-light/30 overflow-y-auto rounded-scrollbar">
        <div class="w-full max-w-2xl bg-surface/90 backdrop-blur-sm p-8 rounded-[2rem] shadow-xl border border-border-subtle my-auto">
            
            <div class="text-center mb-8">
                <a href="/" class="text-4xl font-serif text-primary-dark tracking-tight hover:text-primary transition-colors inline-block mb-1">Stork</a>
                <h1 class="text-2xl font-bold text-text-main">Create your Profile</h1>
                <p class="text-text-muted mt-1 text-sm">Please fill in the details below to join us.</p>
                
                @if ($errors->any())
                    <div class="mt-4 p-3 bg-red-100 text-red-600 rounded-xl text-sm text-left">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ route('register.post') }}" method="POST" 
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
                          // Return 0 if the age calculates to a negative number
                          return calculatedAge < 0 ? 0 : calculatedAge;
                      }
                  }" 
                  class="grid grid-cols-1 md:grid-cols-12 gap-5">
                @csrf
                
                <!-- NAME ROW -->
                <div class="md:col-span-5">
                    <label class="block text-xs font-bold text-text-main mb-1">Last Name*</label>
                    <input type="text" name="last_name" required pattern="[A-Za-z\s]+" title="Letters and spaces only" autocapitalize="words" oninput="this.value = this.value.replace(/\b\w/g, c => c.toUpperCase())" class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="Doe">
                </div>
                <div class="md:col-span-5">
                    <label class="block text-xs font-bold text-text-main mb-1">First Name*</label>
                    <input type="text" name="first_name" required pattern="[A-Za-z\s]+" title="Letters and spaces only" autocapitalize="words" oninput="this.value = this.value.replace(/\b\w/g, c => c.toUpperCase())" class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="John">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-text-main mb-1">M.I (Optional)</label>
                    <input type="text" name="middle_initial" maxlength="1" pattern="[A-Za-z]" title="1 Letter only" autocapitalize="characters" oninput="this.value = this.value.toUpperCase()" class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm text-center uppercase" placeholder="A">
                </div>

                <!-- SEX & CONTACT ROW -->
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-text-main mb-1">Sex*</label>
                    <select name="sex" required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm appearance-none rounded-scrollbar cursor-pointer">
                        <option value="" disabled selected>Select...</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="md:col-span-8">
                    <label class="block text-xs font-bold text-text-main mb-1">Contact No.*</label>
                    <input type="tel" name="contact_no" required maxlength="11" pattern="09[0-9]{9}" title="Must start with 09 and be exactly 11 digits" class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="09XXXXXXXXX">
                </div>

                <!-- EMAIL & PASSWORD ROW -->
                <div class="md:col-span-6">
                    <label class="block text-xs font-bold text-text-main mb-1">E-mail*</label>
                    <input type="email" name="email" required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="you@example.com">
                </div>
                <div class="md:col-span-6">
                    <label class="block text-xs font-bold text-text-main mb-1">Password*</label>
                    <input type="password" name="password" required minlength="8" class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm" placeholder="••••••••">
                </div>

                <!-- BIRTHDAY & AGE ROW -->
                <div class="md:col-span-8">
                    <label class="block text-xs font-bold text-text-main mb-1">Birthday*</label>
                    <input type="date" name="birthday" x-model="birthday" required class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm cursor-pointer text-text-muted">
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-text-main mb-1">Age</label>
                    <input type="number" :value="age" readonly class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface-subtle text-text-muted font-bold outline-none shadow-sm text-sm cursor-not-allowed" placeholder="Auto">
                </div>

                <!-- SUBMIT -->
                <div class="md:col-span-12 mt-2">
                    <button type="submit" class="w-full py-3 px-4 bg-primary hover:bg-primary-dark text-surface text-base font-bold rounded-xl shadow-md transition-colors transform active:scale-[0.98]">
                        Complete Registration
                    </button>
                    <p class="mt-4 text-center text-xs text-text-muted">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-bold text-primary hover:text-primary-dark transition-colors">Sign in here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>