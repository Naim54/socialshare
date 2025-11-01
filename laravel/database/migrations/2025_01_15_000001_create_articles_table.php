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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->text('content');
            $table->string('slug')->unique();
            $table->string('featured_image')->nullable();
            $table->string('category'); // Nation, Economy, Tech, Politics, Business, Sports, Health, World
            $table->enum('type', ['breaking', 'featured', 'normal'])->default('normal');
            $table->string('source')->nullable(); // Publication name (e.g., "STRAITS TIMES", "GlobalSource")
            $table->string('source_logo')->nullable(); // URL or path to source logo/avatar
            $table->integer('reading_time')->nullable(); // Estimated reading time in minutes
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for better query performance
            $table->index('category');
            $table->index('type');
            $table->index('is_published');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

