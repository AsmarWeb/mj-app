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
        Schema::create('supplier_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->decimal(
        'available_balance',
        12,
        2
    )->default(0);


    $table->decimal(
        'pending_balance',
        12,
        2
    )->default(0);


    $table->decimal(
        'total_earned',
        12,
        2
    )->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_wallets');
    }
};
