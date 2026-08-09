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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->longText('description_ar');
            $table->text('short_des');
            $table->text('short_des_ar');
            $table->string('logo');
            $table->string('favicon');
            $table->string('email');
            $table->string('phone');
            $table->string('phone2');
            $table->string('address');
            $table->text('map');
            $table->string('facebook');
            $table->string('telegram');
            $table->string('instagram');
            $table->string('tiktok');
            $table->text('copyright')->nullable();
            $table->text('copyright_ar')->nullable();
            $table->boolean('maintenance_mode')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
