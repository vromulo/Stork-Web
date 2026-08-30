@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
    
    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-serif text-primary-dark tracking-tight">System Administration</h1>
            <p class="text-sm text-text-muted mt-1">Secure Management Portal</p>
        </div>
        
        <!-- Secure Logout -->
        <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
            @csrf
            <button type="submit" class="px-5 py-2.5 bg-surface border border-border-subtle rounded-xl text-sm font-bold text-danger hover:bg-red-50 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-danger/20">
                Secure Sign Out
            </button>
        </form>
    </div>

    <!-- Main Content Area -->
    <div class="bg-surface py-8 px-6 shadow-xl sm:rounded-2xl sm:px-10 border border-border-subtle">
        <h2 class="text-xl font-bold text-text-main mb-2">
            Welcome back, {{ auth('admin')->user()->name }}
        </h2>
        <p class="text-text-muted">
            You have successfully completed two-factor authentication.
        </p>

        <!-- Placeholder Grid for future stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="p-6 bg-surface-subtle rounded-xl border border-border-subtle">
                <h3 class="text-sm font-bold text-text-muted uppercase tracking-wider mb-1">Total Users</h3>
                <p class="text-3xl font-serif text-primary-dark">0</p>
            </div>
            <div class="p-6 bg-surface-subtle rounded-xl border border-border-subtle">
                <h3 class="text-sm font-bold text-text-muted uppercase tracking-wider mb-1">Active Sellers</h3>
                <p class="text-3xl font-serif text-primary-dark">0</p>
            </div>
            <div class="p-6 bg-surface-subtle rounded-xl border border-border-subtle">
                <h3 class="text-sm font-bold text-text-muted uppercase tracking-wider mb-1">System Status</h3>
                <p class="text-xl font-bold text-success mt-2">Online</p>
            </div>
        </div>
    </div>
    
</div>
@endsection