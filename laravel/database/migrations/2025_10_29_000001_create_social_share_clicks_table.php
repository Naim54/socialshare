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
        if (Schema::hasTable('socialdata')) {
            return;
        }

        Schema::create('socialdata', function (Blueprint $table) {
            $table->id();
            $table->enum('platform', ['facebook', 'twitter', 'whatsapp', 'telegram', 'email'])->index();
            $table->foreignId('article_id')->nullable()->constrained('articles')->onDelete('set null');
            $table->string('page_url')->nullable()->index(); // For non-article pages (e.g., welcome page)
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            // Indexes for better query performance
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socialdata');
    }
};

