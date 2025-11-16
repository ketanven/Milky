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
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();

            // Page details
            $table->string('title')->unique(); // e.g., "About Us", "Terms & Conditions"
            $table->string('slug')->unique();  // URL-friendly name
            $table->text('content');            // HTML or Markdown content
            $table->boolean('is_active')->default(true); // show/hide page
            $table->integer('order')->default(0);        // optional sorting order

            // Timestamps
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_pages');
    }
};
