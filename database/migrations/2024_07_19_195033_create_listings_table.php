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
            $table->string('code')->unique()->nullable();
            $table->string('title');
            $table->string('title_ar');
            $table->string('slug');
            $table->string('price');
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('image');
            $table->text('images')->nullable();
            $table->integer('quantity')->default(10);
            $table->integer('views')->default(0);
            $table->integer('clicks')->default(0);
            $table->string('name');
            $table->string('email');
            $table->string('location');
            $table->string('phone_number');
            $table->bigInteger('shop_id')->unsigned()->nullable();
            $table->bigInteger('section_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('subcategory_id')->unsigned()->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->string('price_condition');
            $table->string('condition');
            $table->boolean('featured')->default(false);
            $table->enum('status', ['active', 'pending', 'approved'])->default('active');
            $table->enum('type', ['standard', 'premium'])->default('standard');
            $table->foreignIdFor(User::class, 'user_id')->nullable();
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->softDeletes();
            $table->foreignIdFor(User::class, 'deleted_by')->nullable();
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
