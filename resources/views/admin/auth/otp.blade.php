@extends('layouts.admin')

@section('content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    
    <!-- Header -->
    <div class="text-center">
        <h2 class="text-4xl font-serif text-primary-dark tracking-tight">Stork</h2>
        <h3 class="mt-4 text-xl font-medium text-text-main">Two-Factor Authentication</h3>
        <p class="mt-1 text-sm text-text-muted">Enter the 6-digit code sent to your device.</p>
    </div>

    <!-- OTP Card -->
    <div class="mt-8 bg-surface py-8 px-4 shadow-xl sm:rounded-2xl sm:px-10 border border-border-subtle">
        
        <form class="space-y-6" action="{{ route('admin.otp.verify') }}" method="POST">
            @csrf

            <!-- OTP Input -->
            <div>
                <label for="code" class="block text-sm font-medium text-text-main text-center">Verification Code</label>
                <div class="mt-2">
                    <!-- Adjusted for 6 digit code input -->
                    <input id="code" name="code" type="text" inputmode="numeric" pattern="[0-9]*" maxlength="6" required autofocus
                        class="block w-full text-center tracking-[0.5em] text-2xl font-bold rounded-lg border @error('code') border-danger @else border-border-subtle @enderror px-4 py-3 bg-surface-subtle text-primary-dark placeholder-border-subtle focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-colors"
                        placeholder="••••••">
                </div>
                @error('code')
                    <p class="mt-2 text-sm text-center text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                    class="flex w-full justify-center rounded-lg bg-primary px-4 py-2.5 text-sm font-bold text-surface shadow-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors">
                    Authenticate
                </button>
            </div>
            
            <div class="text-center mt-4">
                <form action="{{ route('admin.otp.resend') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-text-muted hover:text-primary transition-colors">
                        Didn't receive a code? Resend
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection