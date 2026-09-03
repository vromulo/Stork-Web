<div>
    @if ($registrationSuccessful)
        <div class="text-center py-8 animate-fade-in-up">
            <div class="w-20 h-20 bg-success/20 text-success rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-text-main mb-2">Registration Submitted!</h2>
            <p class="text-text-muted max-w-md mx-auto mb-8 leading-relaxed">
                Thank you for applying to be a seller. Please wait for the administrator's approval, which will be sent to <strong>{{ $email }}</strong>.
            </p>
            <a href="/" wire:navigate class="inline-flex py-3 px-6 bg-primary hover:bg-primary-dark text-surface font-bold rounded-xl shadow-md transition-colors">
                Return to Homepage
            </a>
        </div>
    @else
        {{-- Step Progress Indicator --}}
        <div class="flex items-center justify-center mb-8 px-2 overflow-x-auto pb-4 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            @foreach (['Email', 'Personal', 'Address', 'Business', 'Docs', 'Password', 'Review'] as $index => $label)
                @php $num = $index + 1; @endphp
                <div class="flex items-center">
                    <div class="flex flex-col items-center gap-1 mx-1">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-[10px] sm:text-xs font-bold transition-colors shrink-0
                            {{ $currentStep === $num ? 'bg-primary text-surface' : ($currentStep > $num ? 'bg-primary-dark text-surface' : 'bg-surface-subtle text-text-muted') }}">
                            @if ($currentStep > $num)
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            @else
                                {{ $num }}
                            @endif
                        </div>
                        <span class="text-[9px] sm:text-[10px] font-medium text-text-muted whitespace-nowrap hidden sm:block">{{ $label }}</span>
                    </div>
                    @if ($num < 7)
                        <div class="w-4 sm:w-6 h-0.5 shrink-0 {{ $currentStep > $num ? 'bg-primary-dark' : 'bg-border-subtle' }}"></div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- STEP 1: Email --}}
        @if ($currentStep === 1)
            <div class="w-full max-w-md mx-auto space-y-4">
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">E-mail*</label>
                    <input type="email" wire:model.live.debounce.500ms="email" @if ($codeSent) disabled @endif
                        class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm @error('email') border-danger focus:border-danger focus:ring-1 focus:ring-danger @else border-border-subtle focus:border-text-main focus:ring-1 focus:ring-text-main @enderror">
                    @error('email') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                @if (! $codeSent)
                    <button wire:click="sendCode" wire:loading.attr="disabled" class="w-full py-2.5 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl transition-colors disabled:opacity-60">
                        <span wire:loading.remove wire:target="sendCode">Send Verification Code</span>
                        <span wire:loading wire:target="sendCode">Sending...</span>
                    </button>
                @else
                    <div>
                        <label class="block text-xs font-bold text-text-main mb-1">Verification Code*</label>
                        <input type="text" wire:model="code" maxlength="6" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm tracking-[0.5em] text-center font-bold border-border-subtle focus:border-text-main focus:ring-1 focus:ring-text-main">
                        @error('code') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <button wire:click="verifyCode" class="w-full py-2.5 px-4 bg-primary text-surface text-sm font-bold rounded-xl transition-colors">Verify Code</button>
                @endif
            </div>
        @endif

        {{-- STEP 2: Personal Info --}}
        @if ($currentStep === 2)
            <div class="w-full max-w-md mx-auto space-y-4">
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">First Name*</label>
                    <input type="text" wire:model.live="first_name" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm @error('first_name') border-danger focus:border-danger focus:ring-1 focus:ring-danger @else border-border-subtle focus:border-text-main focus:ring-1 focus:ring-text-main @enderror">
                    @error('first_name') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Last Name*</label>
                    <input type="text" wire:model.live="last_name" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm @error('last_name') border-danger @else border-border-subtle focus:border-text-main @enderror">
                    @error('last_name') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Sex*</label>
                    <div class="flex gap-4 mt-2">
                        <label class="flex items-center gap-2"><input type="radio" wire:model.live="sex" value="male" class="w-4 h-4 text-text-main focus:ring-text-main border-border-subtle"><span class="text-sm font-medium">Male</span></label>
                        <label class="flex items-center gap-2"><input type="radio" wire:model.live="sex" value="female" class="w-4 h-4 text-text-main focus:ring-text-main border-border-subtle"><span class="text-sm font-medium">Female</span></label>
                    </div>
                    @error('sex') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Birthday*</label>
                    <input type="date" wire:model.live="birthday" min="{{ now()->subYears(100)->format('Y-m-d') }}" max="{{ now()->subYears(18)->format('Y-m-d') }}" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm @error('birthday') border-danger @else border-border-subtle focus:border-text-main @enderror">
                    @error('birthday') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="flex gap-3 mt-6">
                    <button wire:click="backToStep(1)" class="flex-1 py-2.5 px-4 bg-surface-subtle hover:bg-border-subtle text-text-main text-sm font-bold rounded-xl transition-colors">Back</button>
                    <button wire:click="nextStep(2)" class="flex-[2] py-2.5 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl transition-colors">Continue</button>
                </div>
            </div>
        @endif

        {{-- STEP 3: Contact & Address --}}
        @if ($currentStep === 3)
            <div class="w-full max-w-md mx-auto space-y-4">
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Contact No.*</label>
                    <input type="text" wire:model.live="contact_no" placeholder="09xxxxxxxxx" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm @error('contact_no') border-danger @else border-border-subtle focus:border-text-main @enderror">
                    @error('contact_no') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Province*</label>
                    <div class="relative">
                        <select wire:model.live="province_code" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm appearance-none @error('province_code') border-danger @else border-border-subtle focus:border-text-main @enderror">
                            <option value="">Select Province</option>
                            @foreach($provinces as $prov) <option value="{{ $prov['code'] }}">{{ $prov['name'] }}</option> @endforeach
                        </select>
                        <div wire:loading wire:target="loadProvinces" class="absolute right-3 top-2.5 text-primary text-xs font-bold">Loading...</div>
                    </div>
                    @error('province_code') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Municipality*</label>
                    <div class="relative">
                        <select wire:model.live="municipality_code" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm appearance-none @error('municipality_code') border-danger @else border-border-subtle focus:border-text-main @enderror" @if(empty($municipalities)) disabled @endif>
                            <option value="">Select Municipality</option>
                            @foreach($municipalities as $mun) <option value="{{ $mun['code'] }}">{{ $mun['name'] }}</option> @endforeach
                        </select>
                        <div wire:loading wire:target="province_code" class="absolute right-3 top-2.5 text-primary text-xs font-bold">Loading...</div>
                    </div>
                    @error('municipality_code') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Barangay*</label>
                    <div class="relative">
                        <select wire:model.live="barangay_code" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm appearance-none @error('barangay_code') border-danger @else border-border-subtle focus:border-text-main @enderror" @if(empty($barangays)) disabled @endif>
                            <option value="">Select Barangay</option>
                            @foreach($barangays as $brgy) <option value="{{ $brgy['code'] }}">{{ $brgy['name'] }}</option> @endforeach
                        </select>
                        <div wire:loading wire:target="municipality_code" class="absolute right-3 top-2.5 text-primary text-xs font-bold">Loading...</div>
                    </div>
                    @error('barangay_code') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Street</label>
                    <input type="text" wire:model="street" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm border-border-subtle focus:border-text-main">
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">House/Unit/Building Details</label>
                    <input type="text" wire:model="house_details" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm border-border-subtle focus:border-text-main">
                </div>
                <div class="flex gap-3 mt-6">
                    <button wire:click="backToStep(2)" class="flex-1 py-2.5 px-4 bg-surface-subtle hover:bg-border-subtle text-text-main text-sm font-bold rounded-xl transition-colors">Back</button>
                    <button wire:click="nextStep(3)" class="flex-[2] py-2.5 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl transition-colors">Continue</button>
                </div>
            </div>
        @endif

        {{-- STEP 4: Business Info --}}
        @if ($currentStep === 4)
            <div class="w-full max-w-md mx-auto space-y-4">
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Business/Store Name*</label>
                    <input type="text" wire:model.live="business_name" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm @error('business_name') border-danger @else border-border-subtle focus:border-text-main @enderror">
                    @error('business_name') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Line of Business/Category*</label>
                    <select wire:model.live="line_of_business" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm @error('line_of_business') border-danger @else border-border-subtle focus:border-text-main @enderror">
                        <option value="">Select Category</option>
                        <option value="Fashion & Apparel">Fashion & Apparel</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Home & Living">Home & Living</option>
                        <option value="Health & Beauty">Health & Beauty</option>
                        <option value="Food & Beverages">Food & Beverages</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('line_of_business') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="flex gap-3 mt-6">
                    <button wire:click="backToStep(3)" class="flex-1 py-2.5 px-4 bg-surface-subtle hover:bg-border-subtle text-text-main text-sm font-bold rounded-xl transition-colors">Back</button>
                    <button wire:click="nextStep(4)" class="flex-[2] py-2.5 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl transition-colors">Continue</button>
                </div>
            </div>
        @endif

        {{-- STEP 5: Required Documents --}}
        @if ($currentStep === 5)
            <div class="w-full max-w-md mx-auto space-y-6">
                <!-- Valid ID -->
                <div>
                    <label class="block text-xs font-bold text-text-main mb-2">Upload Valid ID* (JPG, PNG, PDF - Max 5MB)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-id" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer hover:bg-surface-subtle @error('valid_id') border-danger @else border-border-subtle @enderror">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-6 h-6 mb-2 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-1 text-sm text-text-muted"><span class="font-bold">Click to upload</span> or drag and drop</p>
                            </div>
                            <input id="dropzone-id" type="file" wire:model="valid_id" class="hidden" accept=".jpg,.jpeg,.png,.pdf" />
                        </label>
                    </div>
                    @if ($valid_id) <p class="text-xs text-success mt-2 font-bold flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> File attached: {{ $valid_id->getClientOriginalName() }}</p> @endif
                    @error('valid_id') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Business Permit -->
                <div>
                    <label class="block text-xs font-bold text-text-main mb-2">Upload Business Permit* (JPG, PNG, PDF - Max 5MB)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-permit" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer hover:bg-surface-subtle @error('business_permit') border-danger @else border-border-subtle @enderror">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-6 h-6 mb-2 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-1 text-sm text-text-muted"><span class="font-bold">Click to upload</span> or drag and drop</p>
                            </div>
                            <input id="dropzone-permit" type="file" wire:model="business_permit" class="hidden" accept=".jpg,.jpeg,.png,.pdf" />
                        </label>
                    </div>
                    @if ($business_permit) <p class="text-xs text-success mt-2 font-bold flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> File attached: {{ $business_permit->getClientOriginalName() }}</p> @endif
                    @error('business_permit') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="flex gap-3 mt-6">
                    <button wire:click="backToStep(4)" class="flex-1 py-2.5 px-4 bg-surface-subtle hover:bg-border-subtle text-text-main text-sm font-bold rounded-xl transition-colors">Back</button>
                    <button wire:click="nextStep(5)" wire:loading.attr="disabled" class="flex-[2] py-2.5 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl transition-colors">
                        <span wire:loading.remove wire:target="valid_id, business_permit">Continue</span>
                        <span wire:loading wire:target="valid_id, business_permit">Uploading...</span>
                    </button>
                </div>
            </div>
        @endif

        {{-- STEP 6: Password --}}
        @if ($currentStep === 6)
            <div class="w-full max-w-md mx-auto space-y-4">
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Password*</label>
                    <input type="password" wire:model.live.debounce.500ms="password" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm @error('password') border-danger @else border-border-subtle @enderror">
                    @error('password') <p class="text-danger text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-main mb-1">Confirm Password*</label>
                    <input type="password" wire:model.live.debounce.500ms="password_confirmation" class="w-full py-2 px-3 border-2 rounded-xl bg-surface outline-none text-sm @error('password_confirmation') border-danger @else border-border-subtle @enderror">
                </div>
                <div class="flex gap-3 mt-6">
                    <button wire:click="backToStep(5)" class="flex-1 py-2.5 px-4 bg-surface-subtle hover:bg-border-subtle text-text-main text-sm font-bold rounded-xl transition-colors">Back</button>
                    <button wire:click="nextStep(6)" class="flex-[2] py-2.5 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl transition-colors">Continue</button>
                </div>
            </div>
        @endif

        {{-- STEP 7: Review & Submit --}}
        @if ($currentStep === 7)
            <div class="w-full max-w-xl mx-auto space-y-6">
                <!-- Summary Card -->
                <div class="bg-surface-subtle rounded-2xl p-6 border border-border-subtle space-y-6">
                    
                    <div>
                        <div class="flex justify-between items-center mb-2 border-b border-border-subtle pb-1">
                            <h3 class="text-sm font-bold text-primary-dark uppercase tracking-wide">Account & Personal</h3>
                            <button wire:click="backToStep(2)" class="text-xs text-primary hover:underline font-bold">Edit</button>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <p class="text-text-muted">Email:</p><p class="font-medium text-text-main">{{ $email }} <span class="text-success text-xs font-bold ml-1">(Verified)</span></p>
                            <p class="text-text-muted">Name:</p><p class="font-medium text-text-main">{{ $first_name }} {{ $middle_initial }} {{ $last_name }}</p>
                            <p class="text-text-muted">Sex:</p><p class="font-medium text-text-main capitalize">{{ $sex }}</p>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 border-b border-border-subtle pb-1">
                            <h3 class="text-sm font-bold text-primary-dark uppercase tracking-wide">Contact & Address</h3>
                            <button wire:click="backToStep(3)" class="text-xs text-primary hover:underline font-bold">Edit</button>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <p class="text-text-muted">Contact No:</p><p class="font-medium text-text-main">{{ $contact_no }}</p>
                            <p class="text-text-muted">Address:</p>
                            <p class="font-medium text-text-main">
                                {{ $house_details ? $house_details . ', ' : '' }}{{ $street ? $street . ', ' : '' }}
                                {{ $barangay }}, {{ $municipality }}, {{ $province }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 border-b border-border-subtle pb-1">
                            <h3 class="text-sm font-bold text-primary-dark uppercase tracking-wide">Business Information</h3>
                            <button wire:click="backToStep(4)" class="text-xs text-primary hover:underline font-bold">Edit</button>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <p class="text-text-muted">Store Name:</p><p class="font-medium text-text-main">{{ $business_name }}</p>
                            <p class="text-text-muted">Category:</p><p class="font-medium text-text-main">{{ $line_of_business }}</p>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 border-b border-border-subtle pb-1">
                            <h3 class="text-sm font-bold text-primary-dark uppercase tracking-wide">Documents</h3>
                            <button wire:click="backToStep(5)" class="text-xs text-primary hover:underline font-bold">Edit</button>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <p class="text-text-muted flex items-center"><svg class="w-4 h-4 mr-1 text-success" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> Valid ID</p>
                            <p class="font-medium text-text-main truncate" title="{{ $valid_id ? $valid_id->getClientOriginalName() : '' }}">{{ $valid_id ? $valid_id->getClientOriginalName() : 'Attached' }}</p>
                            <p class="text-text-muted flex items-center"><svg class="w-4 h-4 mr-1 text-success" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> Business Permit</p>
                            <p class="font-medium text-text-main truncate" title="{{ $business_permit ? $business_permit->getClientOriginalName() : '' }}">{{ $business_permit ? $business_permit->getClientOriginalName() : 'Attached' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button wire:click="backToStep(6)" class="flex-1 py-3 px-4 bg-surface-subtle hover:bg-border-subtle text-text-main text-sm font-bold rounded-xl transition-colors">Back</button>
                    <button wire:click="register" wire:loading.attr="disabled" class="flex-[2] py-3 px-4 bg-primary hover:bg-primary-dark text-surface text-sm font-bold rounded-xl shadow-md transition-colors disabled:opacity-60">
                        <span wire:loading.remove wire:target="register">Submit Application</span>
                        <span wire:loading wire:target="register">Processing...</span>
                    </button>
                </div>
            </div>
        @endif

        {{-- Already have an account link --}}
        <div class="text-center mt-8 max-w-md mx-auto">
            <p class="text-xs text-text-muted">
                Already have an account? 
                <a href="{{ route('seller.login') }}" wire:navigate class="font-bold text-primary hover:text-primary-dark hover:underline transition-colors">Sign in here</a>
            </p>
        </div>
    @endif
</div>