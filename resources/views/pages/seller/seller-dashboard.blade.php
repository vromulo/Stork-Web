@extends('layouts.app')

@section('content')
<div class="bg-surface font-sans antialiased text-text-main min-h-screen p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-primary-dark">Seller Portal</h1>
            <p class="text-text-muted">Welcome back, {{ auth()->user()->first_name }}</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="p-6 bg-white rounded-2xl shadow-sm border border-border-subtle">
                <h3 class="text-text-muted font-bold mb-2">Total Sales</h3>
                <p class="text-2xl text-primary font-serif">₱0.00</p>
            </div>
            <div class="p-6 bg-white rounded-2xl shadow-sm border border-border-subtle">
                <h3 class="text-text-muted font-bold mb-2">Active Products</h3>
                <p class="text-2xl text-primary font-serif">0</p>
            </div>
            <div class="p-6 bg-white rounded-2xl shadow-sm border border-border-subtle">
                <h3 class="text-text-muted font-bold mb-2">Pending Orders</h3>
                <p class="text-2xl text-primary font-serif">0</p>
            </div>
        </div>
    </div>
</div>
@endsection