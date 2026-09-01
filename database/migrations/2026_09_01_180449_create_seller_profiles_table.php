<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Address & Contact
            $table->string('contact_no');
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('street')->nullable();
            $table->string('house_details')->nullable();
            
            // Business
            $table->string('business_name');
            $table->string('line_of_business');
            
            // Documents (Paths to storage/app/public)
            $table->string('id_path');
            $table->string('permit_path');
            
            // Administrator Approval Status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_profiles');
    }
};