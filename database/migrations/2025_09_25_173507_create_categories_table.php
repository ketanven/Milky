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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // Category details
            $table->string('name')->unique();  // e.g., Milk, Butter, Cheese
            $table->string('slug')->unique();  // URL-friendly name
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Optional category image

            // Status
            $table->boolean('is_active')->default(true);

            // Timestamps
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
