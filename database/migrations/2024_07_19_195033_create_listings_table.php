<?php

use App\Models\User;
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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique()->nullable();
            $table->string('title');
            $table->string('title_ar');
            $table->string('slug');
            $table->string('price');
            $table->integer('quantity')->default(1);
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->json('keywords')->nullable();
            $table->string('image');
            $table->string('video')->nullable();
            $table->integer('video_views')->default(0);
            $table->json('images')->nullable();
            $table->string('price_condition');
            $table->string('condition');
            $table->bigInteger('shop_id')->unsigned()->nullable();
            $table->bigInteger('section_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('subcategory_id')->unsigned()->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->string('local_brand_name')->nullable();
            $table->string('local_brand_name_ar')->nullable();
            $table->foreignIdFor(User::class, 'user_id')->nullable();
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->softDeletes();
            $table->foreignIdFor(User::class, 'deleted_by')->nullable();
            $table->boolean('active')->default(true);
            $table->enum('status', ['draft', 'published', 'expired', 'archived'])->default('draft');
            $table->string('shipping_method')->nullable();
            $table->integer('delivery_days')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('featured')->default(false);
            $table->timestamp('featured_at')->nullable();
            $table->timestamps();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
