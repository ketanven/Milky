<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();

            // Basic authentication fields
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // Admin details
            $table->string('designation')->nullable(); // e.g., Super Admin, Manager
            $table->string('department')->nullable();  // Optional department info

            // Status and access control
            $table->boolean('is_active')->default(true);

            // For token-based auth (optional but recommended)
            $table->rememberToken();

            // Timestamps
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
