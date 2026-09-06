<div class="max-w-2xl mx-auto p-6 bg-surface rounded-3xl border border-border-subtle shadow-sm my-8">
    @if($isSubmitted)
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-success/20 text-success rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h2 class="text-2xl font-bold text-text-main mb-2">Re-application Submitted!</h2>
            <p class="text-text-muted text-sm max-w-md mx-auto mb-6">
                Your updated information and documents have been submitted to the administration. Your status is now <strong>Pending Review</strong>.
            </p>
            <a href="{{ route('seller.seller-dashboard') }}" class="px-6 py-2.5 bg-primary text-white text-sm font-bold rounded-xl hover:bg-primary-dark transition-colors inline-block">
                Return to Dashboard
            </a>
        </div>
    @else
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-primary-dark">Update & Re-apply</h2>
            <p class="text-xs text-text-muted mt-1">Please review the reason your previous submission was not approved, update the required details or documents, and submit revision v{{ ($latestApp->version ?? 1) + 1 }}.</p>
        </div>

        @if($latestApp && $latestApp->rejection_reason)
            <div class="p-4 bg-danger/10 border-l-4 border-danger rounded-r-xl mb-6">
                <strong class="text-xs font-bold text-danger uppercase tracking-wider block">Admin Rejection Feedback:</strong>
                <p class="text-xs text-text-main mt-1 italic font-medium leading-relaxed">"{{ $latestApp->rejection_reason }}"</p>
            </div>
        @endif

        <form wire:submit="reapply" class="space-y-4 text-xs">
            <div>
                <label class="block font-bold text-text-main mb-1">Store / Business Name*</label>
                <input type="text" wire:model="business_name" class="w-full p-2.5 rounded-xl border border-border-subtle bg-surface outline-none focus:border-primary text-sm">
                @error('business_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-bold text-text-main mb-1">Contact Number* (+63)</label>
                <input type="text" wire:model="contact_no" class="w-full p-2.5 rounded-xl border border-border-subtle bg-surface outline-none focus:border-primary text-sm">
                @error('contact_no') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block font-bold text-text-main mb-1">Province*</label>
                    <select wire:model.live="province_code" class="w-full p-2.5 rounded-xl border border-border-subtle bg-surface text-sm">
                        <option value="">{{ $province ?: 'Select Province' }}</option>
                        @foreach($provinces as $prov) <option value="{{ $prov['code'] }}">{{ $prov['name'] }}</option> @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-text-main mb-1">Municipality*</label>
                    <select wire:model.live="municipality_code" class="w-full p-2.5 rounded-xl border border-border-subtle bg-surface text-sm">
                        <option value="">{{ $municipality ?: 'Select City/Municipality' }}</option>
                        @foreach($municipalities as $mun) <option value="{{ $mun['code'] }}">{{ $mun['name'] }}</option> @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-text-main mb-1">Barangay*</label>
                    <select wire:model.live="barangay_code" class="w-full p-2.5 rounded-xl border border-border-subtle bg-surface text-sm">
                        <option value="">{{ $barangay ?: 'Select Barangay' }}</option>
                        @foreach($barangays as $brgy) <option value="{{ $brgy['code'] }}">{{ $brgy['name'] }}</option> @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-text-main mb-1">Street</label>
                    <input type="text" wire:model="street" class="w-full p-2.5 rounded-xl border border-border-subtle bg-surface text-sm">
                </div>
                <div>
                    <label class="block font-bold text-text-main mb-1">House / Unit / Building Details</label>
                    <input type="text" wire:model="house_details" class="w-full p-2.5 rounded-xl border border-border-subtle bg-surface text-sm">
                </div>
            </div>

            <!-- Documents Replacement Dropzones -->
            <div class="pt-2 border-t border-border-subtle space-y-4">
                <div>
                    <label class="block font-bold text-text-main mb-1">Replace Valid ID (Leave blank to keep current)</label>
                    <input type="file" wire:model="valid_id" accept=".jpg,.jpeg,.png,.pdf" class="w-full p-2 rounded-xl border border-border-subtle text-xs bg-surface-subtle">
                    @error('valid_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block font-bold text-text-main mb-1">Replace Business Permit (Leave blank to keep current)</label>
                    <input type="file" wire:model="business_permit" accept=".jpg,.jpeg,.png,.pdf" class="w-full p-2 rounded-xl border border-border-subtle text-xs bg-surface-subtle">
                    @error('business_permit') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('seller.seller-dashboard') }}" class="px-5 py-2.5 bg-surface-subtle text-text-muted hover:text-text-main font-bold rounded-xl text-sm transition-colors">Cancel</a>
                <button type="submit" wire:loading.attr="disabled" class="px-6 py-2.5 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark text-sm shadow-md transition-colors cursor-pointer">
                    <span wire:loading.remove>Submit Re-application</span>
                    <span wire:loading>Uploading & Submitting...</span>
                </button>
            </div>
        </form>
    @endif
</div>