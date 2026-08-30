@extends('layouts.admin')

@section('content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <!-- Branding -->
    <div class="text-center">
        <h2 class="text-4xl font-serif text-primary-dark tracking-tight">Storkia</h2>
        <h3 class="mt-4 text-xl font-medium text-text-main">Admin Portal Access</h3>
        <p class="mt-1 text-sm text-text-muted">Please sign in with your administrator credentials.</p>
    </div>

    <!-- Login Card -->
    <div class="mt-8 bg-surface py-8 px-4 shadow-xl sm:rounded-2xl sm:px-10 border border-border-subtle">
        
        <!-- Standard form submission -->
        <form class="space-y-6" action="{{ route('admin.login') }}" method="POST">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-text-main">Email address</label>
                <div class="mt-1">
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                        class="block w-full appearance-none rounded-lg border @error('email') border-danger @else border-border-subtle @enderror px-4 py-2.5 bg-surface-subtle text-text-main placeholder-text-muted focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 sm:text-sm transition-colors">
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-text-main">Password</label>
                <div class="mt-1">
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                        class="block w-full appearance-none rounded-lg border @error('password') border-danger @else border-border-subtle @enderror px-4 py-2.5 bg-surface-subtle text-text-main placeholder-text-muted focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 sm:text-sm transition-colors">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" 
                        class="h-4 w-4 rounded border-border-subtle text-primary focus:ring-primary/50 bg-surface-subtle cursor-pointer">
                    <label for="remember_me" class="ml-2 block text-sm text-text-muted cursor-pointer">
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-primary hover:text-primary-dark transition-colors">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                    class="flex w-full justify-center rounded-lg bg-primary-dark px-4 py-2.5 text-sm font-medium text-surface shadow-sm hover:bg-text-main focus:outline-none focus:ring-2 focus:ring-primary-dark focus:ring-offset-2 transition-colors">
                    Verify Credentials
                </button>
            </div>
        </form>
    </div>
</div>
@endsection