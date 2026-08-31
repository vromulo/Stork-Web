<div>
    {{-- Step Progress Indicator --}}
    <div class="flex items-center justify-center gap-1 sm:gap-2 mb-6 sm:mb-8 px-2">
        @foreach ([1 => 'Verify Email', 2 => 'Personal Info', 3 => 'Password'] as $num =>$label)
            <div class="flex items-center gap-1 sm:gap-2">
                <div class="flex flex-col items-center gap-1">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-[10px] sm:text-xs font-bold transition-colors
                        {{ $currentStep ===$num ? 'bg-primary text-surface' : ($currentStep >$num ? 'bg-primary-dark text-surface' : 'bg-surface-subtle text-text-muted') }}">
                        @if ($currentStep >$num)
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            {{ $num }}
                        @endif
                    </div>
                    <span class="text-[9px] sm:text-[10px] font-medium text-text-muted whitespace-nowrap">{{ $label }}</span>
                </div>
                @if ($num < 3)
                    <div class="w-4 sm:w-8 h-0.5 {{ $currentStep >$num ? 'bg-primary-dark' : 'bg-border-subtle' }} mb-4"></div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- STEP 1: Verify Email --}}
    @if ($currentStep === 1)
        <div class="w-full max-w-md mx-auto space-y-4 sm:space-y-5">
            <div>
                <label class="block text-xs font-bold text-text-main mb-1">E-mail*</label>
                <input type="email" wire:model="email" @if ($codeSent) disabled @endif
                    class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm disabled:bg-surface-subtle disabled:text-text-muted"
                    placeholder="you@example.com">
                @error('email') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            @if (! $codeSent)
                <button wire:click="sendCode" wire:loading.attr="disabled" wire:target="sendCode"
                    class="w-full py-2.5 sm:py-3 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl shadow-md transition-colors cursor-pointer disabled:cursor-not-allowed disabled:opacity-60">
                    <span wire:loading.remove wire:target="sendCode">Send Verification Code</span>
                    <span wire:loading wire:target="sendCode">Sending...</span>
                </button>
            @else
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Verification Code*</label>
                    <input type="text" wire:model="code" inputmode="numeric" maxlength="6" autocomplete="one-time-code"
                        class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm tracking-[0.5em] text-center font-bold"
                        placeholder="000000">
                    @error('code') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
                    <p class="text-text-muted text-xs mt-1 text-center sm:text-left">We sent a 6-digit code to {{ $email }}.</p>
                </div>

                <button wire:click="verifyCode" wire:loading.attr="disabled" wire:target="verifyCode"
                    class="w-full py-2.5 sm:py-3 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl shadow-md transition-colors cursor-pointer disabled:cursor-not-allowed disabled:opacity-60">
                    <span wire:loading.remove wire:target="verifyCode">Verify Code</span>
                    <span wire:loading wire:target="verifyCode">Verifying...</span>
                </button>

                <div class="text-center" x-data="{ seconds: {{ $resendCooldown }} }"
                    x-init="let t = setInterval(() => { if (seconds > 0) seconds--; else clearInterval(t); }, 1000)">
                    <button wire:click="resendCode" wire:loading.attr="disabled" wire:target="resendCode"
                        x-bind:disabled="seconds > 0"
                        class="text-xs font-bold text-primary hover:text-primary-dark transition-colors cursor-pointer disabled:text-text-muted disabled:cursor-not-allowed">
                        <span x-show="seconds === 0">Resend Code</span>
                        <span x-show="seconds > 0">Resend available in <span x-text="seconds"></span>s</span>
                    </button>
                </div>
            @endif
        </div>
    @endif

    {{-- STEP 2: Personal Info --}}
    @if ($currentStep === 2)
        <div class="w-full max-w-2xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-4 sm:gap-5">
            <div class="md:col-span-5">
                <label class="block text-xs font-bold text-text-main mb-1">Last Name*</label>
                <input type="text" wire:model="last_name"
                    class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm"
                    placeholder="Doe">
                @error('last_name') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-5">
                <label class="block text-xs font-bold text-text-main mb-1">First Name*</label>
                <input type="text" wire:model="first_name"
                    class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm"
                    placeholder="John">
                @error('first_name') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-text-main mb-1">M.I.</label>
                <input type="text" wire:model="middle_initial" maxlength="1"
                    class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm text-center uppercase"
                    placeholder="A">
                @error('middle_initial') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-4">
                <label class="block text-xs font-bold text-text-main mb-1">Sex*</label>
                <select wire:model="sex"
                    class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm appearance-none cursor-pointer">
                    <option value="">Select...</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('sex') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-4">
                <label class="block text-xs font-bold text-text-main mb-1">Birthday*</label>
                <input type="date" wire:model.live="birthday"
                    class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm cursor-pointer text-text-muted">
                @error('birthday') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-4">
                <label class="block text-xs font-bold text-text-main mb-1">Age</label>
                <input type="number" value="{{ $this->computedAge() }}" readonly
                    class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface-subtle text-text-muted font-bold outline-none shadow-sm text-sm cursor-not-allowed"
                    placeholder="Auto">
            </div>

            <div class="md:col-span-12 flex gap-2 sm:gap-3 mt-2">
                <button wire:click="backToStep(1)" type="button"
                    class="flex-1 py-2.5 sm:py-3 px-4 bg-surface-subtle hover:bg-border-subtle text-text-main text-sm font-bold rounded-xl transition-colors cursor-pointer">
                    Back
                </button>
                <button wire:click="goToPasswordStep" wire:loading.attr="disabled" wire:target="goToPasswordStep"
                    class="flex-[2] py-2.5 sm:py-3 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl shadow-md transition-colors cursor-pointer disabled:cursor-not-allowed disabled:opacity-60">
                    Continue
                </button>
            </div>
        </div>
    @endif

    {{-- STEP 3: Password --}}
    @if ($currentStep === 3)
        <div class="w-full max-w-md mx-auto space-y-4 sm:space-y-5">
            <div>
                <label class="block text-xs font-bold text-text-main mb-1">Password*</label>
                <input type="password" wire:model="password"
                    class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm"
                    placeholder="••••••••">
                @error('password') <p class="text-danger text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-text-main mb-1">Confirm Password*</label>
                <input type="password" wire:model="password_confirmation"
                    class="w-full py-2 px-3 border-2 border-border-subtle rounded-xl bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm text-sm"
                    placeholder="••••••••">
            </div>

            <div class="flex gap-2 sm:gap-3 mt-2">
                <button wire:click="backToStep(2)" type="button"
                    class="flex-1 py-2.5 sm:py-3 px-4 bg-surface-subtle hover:bg-border-subtle text-text-main text-sm font-bold rounded-xl transition-colors cursor-pointer">
                    Back
                </button>
                <button wire:click="register" wire:loading.attr="disabled" wire:target="register"
                    class="flex-[2] py-2.5 sm:py-3 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl shadow-md transition-colors cursor-pointer disabled:cursor-not-allowed disabled:opacity-60">
                    <span wire:loading.remove wire:target="register">Complete</span>
                    <span wire:loading wire:target="register">Creating...</span>
                </button>
            </div>
        </div>
    @endif
</div>