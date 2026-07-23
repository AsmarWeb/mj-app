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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

    // Page hierarchy
    $table->foreignId('parent_id')
          ->nullable()
          ->constrained('pages')
          ->nullOnDelete();

    // Basic information
    $table->string('name', 255)->nullable();
    $table->string('slug', 255)->unique();

    // English
    $table->string('title')->nullable();
    $table->string('subtitle')->nullable();

    $table->text('short_des')->nullable();
    $table->mediumText('content')->nullable();


    // Arabic
    $table->string('title_ar')->nullable();
    $table->string('subtitle_ar')->nullable();

    $table->text('short_des_ar')->nullable();
    $table->mediumText('content_ar')->nullable();


    // Page settings
    $table->string('template')->default('default');

    $table->enum('status', [
        'draft',
        'published',
        'archived'
    ])->default('draft');

    $table->timestamp('published_at')->nullable();

    $table->integer('sort_order')->default(0);


    // Image
    $table->string('image')->nullable();
    $table->string('image_alt')->nullable();


    // URL
    $table->string('url', 255)->nullable();


    // SEO
    $table->string('meta_title')->nullable();
    $table->string('meta_keywords')->nullable();
    $table->text('meta_description')->nullable();


    // Audit information
    $table->string('created_by')->nullable();
    $table->string('created_by_ar')->nullable();

    $table->string('developer')->nullable();


    $table->timestamps();

    $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
