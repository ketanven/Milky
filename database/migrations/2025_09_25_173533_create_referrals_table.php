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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('referrer_id')->constrained('users')->cascadeOnDelete(); // user who referred
            $table->foreignId('referred_id')->constrained('users')->cascadeOnDelete(); // user who was referred

            // Referral details
            $table->enum('status', ['pending', 'registered', 'rewarded'])->default('pending');
            $table->decimal('reward_amount', 10, 2)->default(0); // reward credited to referrer
            $table->text('note')->nullable();

            // Timestamps
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
