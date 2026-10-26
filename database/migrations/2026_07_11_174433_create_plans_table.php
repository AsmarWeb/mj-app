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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 8, 2);
            $table->string('stripe_price')->nullable()->unique();
            $table->integer('listing_limit')->default(1);
            $table->integer('listing_duration')->nullable();
            $table->integer('order_limit')->default(0);
            $table->integer('storage_limit')->default(0);
            $table->boolean('custom_domain')->default(false);
            $table->boolean('mobile_app')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_free')->default(false);
            $table->enum('billing_period', ['monthly', 'yearly'])->default('monthly');
            $table->timestamps();
        });
        Schema::table('shops', fn (Blueprint $table) => $table->foreign('plan_id')->references('id')->on('plans')->nullOnDelete());
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shops', fn (Blueprint $table) => $table->dropForeign(['plan_id']));
        Schema::dropIfExists('plans');
    }
};
