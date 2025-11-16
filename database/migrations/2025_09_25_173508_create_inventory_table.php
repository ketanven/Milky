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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();

            // Link to product
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();

            // Stock details
            $table->integer('stock')->default(0); // current stock
            $table->integer('reserved')->default(0); // reserved for pending orders
            $table->integer('sold')->default(0); // total sold

            // Optional notes
            $table->text('notes')->nullable();

            // Timestamps
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
