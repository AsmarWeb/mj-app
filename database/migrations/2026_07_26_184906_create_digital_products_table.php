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
        Schema::create('digital_products', function (Blueprint $table) {
            $table->id();
            // Basic Information
    $table->string('title');
    $table->string('title_ar')->nullable();

    $table->text('description');
    $table->text('description_ar')->nullable();

    $table->string('slug')->unique();


    // Pricing
    $table->decimal('price', 10, 2)->default(0);

    $table->boolean('is_free')->default(false);


    // Files
    $table->string('image');

    // Main downloadable file
    $table->string('file');


    // Product Information
    $table->string('version')->nullable();

    $table->string('compatible_with')->nullable();
    // Photoshop, Figma, Canva, WordPress...


    $table->string('file_size')->nullable();
    // 250 MB


    $table->string('included_files')->nullable();
    // PSD, AI, SVG, PNG


    $table->enum('license', [
        'personal',
        'commercial',
        'extended'
    ])->default('personal');


    // Preview
    $table->string('preview_url')->nullable();

    $table->string('video_url')->nullable();


    // Extra Information
    $table->text('requirements')->nullable();

    $table->text('installation')->nullable();

    $table->text('changelog')->nullable();


    // Gallery Images
    $table->json('gallery')->nullable();


    // Marketplace Stats
    $table->unsignedBigInteger('downloads')->default(0);

    $table->unsignedBigInteger('favorites')->default(0);

    $table->decimal('rating', 3, 2)->default(0);

    $table->unsignedInteger('reviews')->default(0);



    // Featured
    $table->boolean('featured')->default(false);



    // Category
    $table->foreignId('digital_category_id')
        ->nullable()
        ->constrained('digital_categories')
        ->nullOnDelete();



    // Seller
    $table->bigInteger('shop_id')->unsigned()->nullable();



    // Status
    $table->enum('status', [
        'draft',
        'published',
        'archived'
    ])->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_products');
    }
};
