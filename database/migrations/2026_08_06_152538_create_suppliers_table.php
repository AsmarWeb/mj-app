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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            // Supplier owner / account
    $table->foreignId('user_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    // Invitation
    $table->uuid('invite_token')
        ->nullable()
        ->unique();

    $table->timestamp('invited_at')
        ->nullable();

    // =========================================================
    // BASIC INFORMATION
    // =========================================================

    $table->string('name');

    $table->string('company')
        ->nullable();

    $table->string('email')
        ->nullable();

    $table->string('phone')
        ->nullable();

    $table->string('whatsapp')
        ->nullable();

    // =========================================================
    // UAE INFORMATION
    // =========================================================

    $table->string('country')
        ->default('UAE');

    $table->string('emirate')
        ->nullable();

    $table->text('address')
        ->nullable();

    $table->string('vat_number')
        ->nullable();

    // =========================================================
    // SUPPLIER TYPE
    // =========================================================

    $table->enum('supplier_type', [
        'pod',
        'manufacturer',
        'wholesaler',
        'distributor',
        'local'
    ])->default('pod');

    $table->enum('type', [
        'local',
        'printful',
        'printify',
        'other'
    ])->default('local');

    // =========================================================
    // WEBSITE
    // =========================================================

    $table->string('website')
        ->nullable();

    // =========================================================
    // API / INTEGRATION
    // =========================================================

    $table->text('api_key')
        ->nullable();

    $table->text('api_secret')
        ->nullable();

    $table->string('api_base_url')
        ->nullable();

    $table->boolean('api_enabled')
        ->default(false);

    // =========================================================
    // MARKETPLACE
    // =========================================================

    $table->decimal('commission', 10, 2)
        ->default(0);

    $table->enum('commission_type', [
        'percentage',
        'fixed'
    ])->default('percentage');

    // =========================================================
    // STATUS
    // =========================================================

    $table->enum('status', [
        'active',
        'inactive',
        'pending',
        'suspended'
    ])->default('active');

    // =========================================================
    // TIMESTAMPS
    // =========================================================
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
