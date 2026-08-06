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

            /*
            |--------------------------------------------------------------------------
            | Product Type
            |--------------------------------------------------------------------------
            */

            $table->enum('type', ['digital','pod','service',])->default('digital');

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

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
            $table->string('file')->nullable();

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
                'extended',
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

            /*
            |--------------------------------------------------------------------------
            | Print On Demand
            |--------------------------------------------------------------------------
            */

            /*
            |--------------------------------------------------------------------------
            | POD Supplier
            |--------------------------------------------------------------------------
            */


            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();

            $table->string('base_product')->nullable();
            // T-Shirt, Mug, Hoodie...

            $table->decimal('base_cost',10,2)->nullable();

            $table->json('sizes')->nullable();
            // ["S","M","L","XL"]

            $table->json('colors')->nullable();
            // ["Black","White","Blue"]

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
            

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Ownership
            |--------------------------------------------------------------------------
            */

            $table->foreignId('designer_id')->nullable()->constrained('users')->nullOnDelete();

            $table->unsignedTinyInteger('commission')->default(10);

            $table->boolean('requires_approval')->default(true);

            // Status
            $table->enum('status', [
                'draft',
                'published',
                'archived',
            ])->default('published');

            $table->integer('processing_days')->nullable();
            // 3-5 days

            $table->boolean('fulfillment_enabled')->default(false);

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
