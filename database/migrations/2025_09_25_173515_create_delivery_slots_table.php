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
        Schema::create('delivery_slots', function (Blueprint $table) {
            $table->id();

            // Slot details
            $table->string('slot_name'); // e.g., "Morning Slot", "8-10 AM"
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_orders')->nullable(); // Optional: limit orders per slot
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
        Schema::dropIfExists('delivery_slots');
    }
};
