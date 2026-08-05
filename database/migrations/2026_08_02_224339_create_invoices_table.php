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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // Optional: invoice can belong to a store order
            $table->foreignId('shop_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Optional: invoice can belong to an order
            $table->foreignId('order_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('invoice_number')
                ->unique();

            // For manual invoices
            $table->string('customer_name')
                ->nullable();

            $table->string('customer_email')
                ->nullable();

            $table->string('customer_phone')
                ->nullable();

            $table->decimal('subtotal', 10, 2)
                ->default(0);

            $table->decimal('tax', 10, 2)
                ->default(0);

            $table->decimal('total', 10, 2)
                ->default(0);

            $table->string('status')
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
