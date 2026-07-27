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
        Schema::create('digital_categories', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('category_name');
            $table->string('category_name_ar');
            $table->string('slug')->unique();
            $table->bigInteger('section_id')->unsigned()->nullable();
            $table->string('image')->nullable();
            $table->string('bg_color')->default('#6366F1');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_categories');
    }
};
