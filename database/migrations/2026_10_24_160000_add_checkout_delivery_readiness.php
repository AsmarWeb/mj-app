<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('checkout_token', 36)->nullable()->unique();
            $table->string('checkout_key', 64)->nullable()->unique();
            $table->string('stripe_checkout_session_id')->nullable()->unique();
            $table->string('stripe_payment_intent_id')->nullable()->unique();
            $table->string('checkout_state', 20)->nullable()->index();
            $table->timestamp('checkout_expires_at')->nullable();
            $table->boolean('inventory_reserved')->default(false);
            $table->text('shipping_address')->nullable();
            $table->longText('checkout_payload')->nullable();
            $table->string('checkout_currency', 3)->nullable();
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('source_cart_item_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('order_items', fn (Blueprint $table) => $table->dropColumn('source_cart_item_id'));
        Schema::table('orders', function (Blueprint $table) {
            foreach (['checkout_token', 'checkout_key', 'stripe_checkout_session_id', 'stripe_payment_intent_id'] as $field) {
                $table->dropUnique([$field]);
            }
            $table->dropIndex(['checkout_state']);
            $table->dropColumn(['checkout_token', 'checkout_key', 'stripe_checkout_session_id', 'stripe_payment_intent_id', 'checkout_state', 'checkout_expires_at', 'inventory_reserved', 'shipping_address', 'checkout_payload', 'checkout_currency']);
        });
    }
};
