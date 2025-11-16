<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();

            // Role-based access
            $table->enum('role', ['customer', 'seller', 'admin'])->default('customer');

            // Profile info
            $table->string('profile_image')->nullable();
            $table->string('gender')->nullable(); // male/female/other
            $table->date('dob')->nullable();

            // Account status
        $table->boolean('is_active')->default(true);

            // Authentication
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
        Schema::dropIfExists('users');
    }
};
