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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('plan_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('status', ['active', 'expired', 'cancelled'])->nullable();
            $table->foreignId('user_id');
            $table->string('payment_provider')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('type');
            $table->string('stripe_id')->unique();
            $table->string('stripe_status');
            $table->string('stripe_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'stripe_status']);
        });
        Schema::table('payments', fn (Blueprint $table) => $table->foreign('subscription_id')->references('id')->on('subscriptions')->cascadeOnDelete());
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', fn (Blueprint $table) => $table->dropForeign(['subscription_id']));
        Schema::dropIfExists('subscriptions');
    }
};
