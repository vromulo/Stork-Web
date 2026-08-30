@extends('layouts.app')

@section('content')
<div class="bg-surface font-sans antialiased text-text-main min-h-screen p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-primary-dark">Logistics Operations</h1>
            <p class="text-text-muted">Driver/Handler: {{ auth()->user()->first_name }}</p>
        </div>

        <!-- Action Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="p-6 bg-white rounded-2xl shadow-sm border border-border-subtle">
                <h2 class="text-xl font-bold mb-4">Parcels to Pick Up</h2>
                <p class="text-text-muted text-sm">No pending pickups at this time.</p>
            </div>
            
            <div class="p-6 bg-white rounded-2xl shadow-sm border border-border-subtle">
                <h2 class="text-xl font-bold mb-4">In Transit</h2>
                <p class="text-text-muted text-sm">No active deliveries.</p>
            </div>
        </div>
    </div>
</div>
@endsection