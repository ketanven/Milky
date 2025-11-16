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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();

            // Subscription details
            $table->enum('plan', ['daily', 'weekly']);
            $table->enum('status', ['active', 'paused', 'cancelled'])->default('active');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2); // price per delivery
            $table->date('start_date');
            $table->date('end_date')->nullable(); // null if ongoing
            $table->boolean('auto_renew')->default(true);

            // Timestamps
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
