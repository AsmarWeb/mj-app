<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raslo_connections', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->foreignId('shop_id')->unique()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('remote_id')->unique();
            $table->boolean('enabled')->default(false);
            $table->text('api_key');
            $table->text('webhook_secret')->nullable();
            $table->timestamp('verified_at');
            $table->timestamps();
        });
        Schema::create('raslo_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('raslo_connection_id')->constrained()->restrictOnDelete();
            $table->string('external_order_id', 120)->unique();
            $table->uuid('idempotency_key')->unique();
            $table->longText('payload');
            $table->uuid('remote_id')->nullable()->unique();
            $table->string('state', 30)->index();
            $table->string('delivery_status', 60)->nullable();
            $table->unsignedBigInteger('sequence')->default(0);
            $table->string('tracking_number')->nullable();
            $table->text('tracking_url')->nullable();
            $table->string('delivery_fee')->nullable();
            $table->boolean('requires_price_approval')->default(true);
            $table->unsignedInteger('attempts')->default(0);
            $table->string('error_code', 60)->nullable();
            $table->timestamp('next_attempt_at')->nullable()->index();
            $table->timestamp('queued_at')->nullable();
            $table->uuid('lease')->nullable();
            $table->timestamp('processing_at')->nullable();
            $table->timestamp('last_polled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raslo_shipments');
        Schema::dropIfExists('raslo_connections');
    }
};
