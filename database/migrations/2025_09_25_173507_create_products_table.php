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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('seller_id')->constrained('sellers')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            // Product details
            $table->string('name');
            $table->string('sku')->unique()->nullable(); // optional SKU
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(0); // stock quantity
            $table->string('unit')->nullable(); // e.g., litre, kg, piece
            $table->string('freshness')->nullable(); // e.g., Fresh, 1-day-old
            $table->string('image')->nullable(); // main product image
            $table->boolean('is_active')->default(true); // visibility

            // Timestamps
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
