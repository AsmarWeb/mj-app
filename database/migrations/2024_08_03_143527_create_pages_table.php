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
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('subtitle_ar')->nullable();
            $table->text('short_des')->nullable();
            $table->text('short_des_ar')->nullable();
            $table->mediumText('content')->nullable();
            $table->mediumText('content_ar')->nullable();
            $table->string('created_by')->nullable();
            $table->string('created_by_ar')->nullable();
            $table->string('developer')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('active');
            $table->string('url', 200)->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
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
